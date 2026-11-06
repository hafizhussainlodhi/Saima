<?php

namespace Tests\Feature;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class LeadSourceUrlTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Prevent real external webhook calls during automated tests
        Http::fake([
            '*' => Http::response(['status' => 'success', 'test' => true], 200),
        ]);
    }

    /**
     * Test lead submission from Project page with explicit page_url
     */
    public function test_lead_stores_project_page_url()
    {
        $projectUrl = 'http://127.0.0.1:8000/project/wadeem-gardens';

        $response = $this->postJson(route('leads.store'), [
            'name' => 'TEST - Project Page Lead',
            'phone' => '+971501111111',
            'email' => 'test-project-lead@example.com',
            'comment' => 'TEST: Checking project source page url',
            'project' => 'Wadeem Gardens',
            'page_url' => $projectUrl,
            'campaign_url' => $projectUrl,
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $this->assertDatabaseHas('leads', [
            'name' => 'TEST - Project Page Lead',
            'email' => 'test-project-lead@example.com',
            'page_url' => $projectUrl,
        ]);
    }

    /**
     * Test lead submission from Area / Community page
     */
    public function test_lead_stores_area_page_url()
    {
        $areaUrl = 'http://127.0.0.1:8000/area/hudayriyat-island';

        $response = $this->postJson(route('leads.store'), [
            'name' => 'TEST - Area Page Lead',
            'phone' => '+971502222222',
            'email' => 'test-area-lead@example.com',
            'comment' => 'TEST: Checking area source page url',
            'project' => 'Hudayriyat Island Area',
            'page_url' => $areaUrl,
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('leads', [
            'name' => 'TEST - Area Page Lead',
            'page_url' => $areaUrl,
        ]);
    }

    /**
     * Test lead submission from City page
     */
    public function test_lead_stores_city_page_url()
    {
        $cityUrl = 'http://127.0.0.1:8000/city/abu-dhabi';

        $response = $this->postJson(route('leads.store'), [
            'name' => 'TEST - City Page Lead',
            'phone' => '+971503333333',
            'email' => 'test-city-lead@example.com',
            'comment' => 'TEST: Checking city source page url',
            'project' => 'Abu Dhabi City',
            'page_url' => $cityUrl,
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('leads', [
            'name' => 'TEST - City Page Lead',
            'page_url' => $cityUrl,
        ]);
    }

    /**
     * Test lead submission from Home page
     */
    public function test_lead_stores_home_page_url()
    {
        $homeUrl = 'http://127.0.0.1:8000/';

        $response = $this->postJson(route('leads.store'), [
            'name' => 'TEST - Home Page Lead',
            'phone' => '+971504444444',
            'email' => 'test-home-lead@example.com',
            'comment' => 'TEST: Checking home source page url',
            'project' => 'Hudayriyat Island',
            'page_url' => $homeUrl,
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('leads', [
            'name' => 'TEST - Home Page Lead',
            'page_url' => $homeUrl,
        ]);
    }

    /**
     * Test lead submission from Dynamic Blog page
     */
    public function test_lead_stores_dynamic_blog_page_url()
    {
        $blogUrl = 'http://127.0.0.1:8000/blog/future-of-luxury-living';

        $response = $this->postJson(route('leads.store'), [
            'name' => 'TEST - Dynamic Blog Lead',
            'phone' => '+971505555555',
            'email' => 'test-blog-lead@example.com',
            'comment' => 'TEST: Checking dynamic blog source page url',
            'project' => 'Luxury Living Blog',
            'page_url' => $blogUrl,
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('leads', [
            'name' => 'TEST - Dynamic Blog Lead',
            'page_url' => $blogUrl,
        ]);
    }

    /**
     * Test HTTP Referer fallback when page_url payload field is empty
     */
    public function test_lead_falls_back_to_referer_header_url()
    {
        $refererUrl = 'http://127.0.0.1:8000/project/al-naseem-villas';

        $response = $this->withHeaders([
            'referer' => $refererUrl,
        ])->postJson(route('leads.store'), [
            'name' => 'TEST - Referer Header Lead',
            'phone' => '+971506666666',
            'email' => 'test-referer-lead@example.com',
            'comment' => 'TEST: Checking HTTP Referer fallback url',
            'project' => 'Al Naseem Villas',
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('leads', [
            'name' => 'TEST - Referer Header Lead',
            'page_url' => $refererUrl,
        ]);
    }

    /**
     * Test Admin lead show view displays the page_url
     */
    public function test_admin_lead_show_view()
    {
        $user = User::first() ?? User::factory()->create(['role' => 'admin']);

        $lead = Lead::create([
            'name' => 'TEST - Admin Show Lead',
            'phone' => '+971507777777',
            'email' => 'test-admin-show@example.com',
            'comment' => 'TEST: Verifying Admin view shows page url',
            'project' => 'Bashayer Residences',
            'page_url' => 'http://127.0.0.1:8000/project/bashayer-residences',
            'status' => 'new',
        ]);

        $response = $this->actingAs($user)->get(route('admin.leads.show', $lead));
        $response->assertStatus(200);
        $response->assertSee('http://127.0.0.1:8000/project/bashayer-residences');
        $response->assertSee('TEST - Admin Show Lead');
    }

    /**
     * Test CSV export contains Page URL header and value
     */
    public function test_admin_lead_csv_export_includes_page_url()
    {
        $user = User::first() ?? User::factory()->create(['role' => 'admin']);

        Lead::create([
            'name' => 'TEST - CSV Export Lead',
            'phone' => '+971508888888',
            'email' => 'test-csv-export@example.com',
            'comment' => 'TEST: CSV Export check',
            'project' => 'Hudayriyat Island',
            'page_url' => 'http://127.0.0.1:8000/project/export-test',
            'status' => 'new',
        ]);

        $response = $this->actingAs($user)->get(route('admin.leads.export'));
        $response->assertStatus(200);
        $content = $response->streamedContent();

        $this->assertStringContainsString('Page URL', $content);
        $this->assertStringContainsString('http://127.0.0.1:8000/project/export-test', $content);
    }
}
