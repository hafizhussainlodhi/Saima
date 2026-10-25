<?php

namespace Tests\Feature;

use App\Models\FooterSection;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminSiteSettingsTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        // Create an admin user with full permissions
        $this->admin = User::firstOrCreate(
            ['email' => 'admin@hudayriyat.test'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('password123'),
                'role' => 'admin',
                'permissions' => ['*'],
                'is_active' => true,
            ]
        );
    }

    public function test_admin_can_view_seo_indexing_page(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.seo.index'));
        $response->assertStatus(200);
        $response->assertSee('Search Engine Indexing');
        $response->assertSee('Default SEO Meta Tags');
    }

    public function test_admin_can_toggle_indexing_off_and_reflects_in_public_head(): void
    {
        // 1. Turn indexing OFF
        $response = $this->actingAs($this->admin)->put(route('admin.seo.update'), [
            'indexing_enabled' => '0',
            'default_title' => 'Custom Hudayriyat Title',
            'default_description' => 'Test Description',
        ]);

        $response->assertRedirect(route('admin.seo.index'));
        $this->assertFalse(is_indexing_enabled());

        // 2. Check public page has noindex, nofollow
        $public = $this->get('/');
        $public->assertStatus(200);
        $public->assertSee('<meta name="robots" content="noindex, nofollow">', false);

        // 3. Turn indexing back ON
        $response = $this->actingAs($this->admin)->put(route('admin.seo.update'), [
            'indexing_enabled' => '1',
            'default_title' => 'Hudayriyat Island Luxury',
            'default_description' => 'Live description',
        ]);

        $response->assertRedirect(route('admin.seo.index'));
        $this->assertTrue(is_indexing_enabled());

        $public = $this->get('/');
        $public->assertStatus(200);
        $public->assertSee('<meta name="robots" content="index, follow', false);
    }

    public function test_admin_can_view_footer_management_page(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.footer.index'));
        $response->assertStatus(200);
        $response->assertSee('Brand &amp; Newsletter', false);
        $response->assertSee('Social Links');
        $response->assertSee('Footer Columns');
        $response->assertSee('Bottom Bar');
    }

    public function test_admin_can_update_footer_brand_and_columns_and_reflects_on_frontend(): void
    {
        $updatedColumns = [
            [
                'header' => 'Explore Communities',
                'links' => [
                    ['label' => 'Villas Collection', 'url' => '/villas'],
                    ['label' => 'Mansions Collection', 'url' => '/mansions'],
                ]
            ],
            [
                'header' => 'Legal & Terms',
                'links' => [
                    ['label' => 'Privacy Policy', 'url' => '/privacy'],
                ]
            ]
        ];

        $response = $this->actingAs($this->admin)->put(route('admin.footer.update'), [
            'brand_title' => 'Saima Real Estate',
            'brand_description' => 'Custom advisory for luxury waterfront properties.',
            'columns' => $updatedColumns,
            'disclaimer_text' => 'Updated legal disclaimer for testing.',
            'copyright_text' => '© 2026 Saima Group. All Rights Reserved.',
        ]);

        $response->assertRedirect();
        
        // Check database
        $footer = FooterSection::current();
        $this->assertEquals('Saima Real Estate', $footer->brand_title);
        $this->assertEquals('Explore Communities', $footer->columns[0]['header']);
        $this->assertEquals('Villas Collection', $footer->columns[0]['links'][0]['label']);

        // Check frontend renders dynamic footer
        $frontend = $this->get('/');
        $frontend->assertStatus(200);
        $frontend->assertSee('Saima Real Estate');
        $frontend->assertSee('Explore Communities');
        $frontend->assertSee('Villas Collection');
        $frontend->assertSee('Updated legal disclaimer for testing.');
    }

    public function test_user_management_crud_with_granular_permissions(): void
    {
        // 1. Create a new user with limited granular permissions (only leads)
        $createResponse = $this->actingAs($this->admin)->post(route('admin.users.store'), [
            'name' => 'Agent Ali',
            'email' => 'ali@hudayriyat.test',
            'password' => 'secret123',
            'role' => 'editor',
            'permissions' => ['leads'],
            'is_active' => '1',
        ]);

        $createResponse->assertRedirect(route('admin.users.index'));

        $newUser = User::where('email', 'ali@hudayriyat.test')->first();
        $this->assertNotNull($newUser);
        $this->assertTrue($newUser->hasPermission('leads'));
        $this->assertFalse($newUser->hasPermission('seo'));
        $this->assertFalse($newUser->hasPermission('footer'));

        // 2. Restricted user can access Leads but is blocked from SEO and Users
        $leadAccess = $this->actingAs($newUser)->get(route('admin.leads.index'));
        $leadAccess->assertStatus(200);

        $seoAccess = $this->actingAs($newUser)->get(route('admin.seo.index'));
        $seoAccess->assertStatus(403);

        $usersAccess = $this->actingAs($newUser)->get(route('admin.users.index'));
        $usersAccess->assertStatus(403);

        // 3. Admin updates permissions to grant SEO access
        $updateResponse = $this->actingAs($this->admin)->put(route('admin.users.update', $newUser), [
            'name' => 'Agent Ali Senior',
            'email' => 'ali@hudayriyat.test',
            'role' => 'editor',
            'permissions' => ['leads', 'seo'],
            'is_active' => '1',
        ]);

        $updateResponse->assertRedirect(route('admin.users.index'));
        $newUser->refresh();
        $this->assertTrue($newUser->hasPermission('seo'));

        // 4. Clean up
        $newUser->delete();
    }
}
