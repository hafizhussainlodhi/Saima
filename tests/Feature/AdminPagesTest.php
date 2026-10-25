<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Page;
use App\Models\PageSection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_pages_screen_can_be_rendered(): void
    {
        $user = User::first() ?? User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/pages');

        $response->assertStatus(200);
        $response->assertSee('Pages Management');
    }

    public function test_admin_projects_screen_can_be_rendered(): void
    {
        $user = User::first() ?? User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/projects');

        $response->assertStatus(200);
        $response->assertSee('Projects Management');
        $response->assertSee('Projects & Communities');
    }

    public function test_admin_page_editor_can_be_rendered(): void
    {
        $user = User::factory()->create();
        $page = Page::create([
            'title' => 'Test Page',
            'slug' => 'test-page',
            'in_navbar' => true,
            'navbar_order' => 1,
            'is_published' => true,
        ]);

        $section = PageSection::create([
            'page_id' => $page->id,
            'section_key' => 'hero',
            'section_name' => 'Hero Section',
            'order' => 1,
            'is_active' => true,
            'content' => ['title' => 'Test Hero Title'],
        ]);

        $response = $this->actingAs($user)->get("/admin/pages/{$page->id}/edit");
        $response->assertStatus(200);
        $response->assertSee('Edit Page: Test Page');
        $response->assertSee('Hero Section');
        $response->assertSee('Test Hero Title');
    }

    public function test_admin_can_update_page_and_sections(): void
    {
        $user = User::factory()->create();
        $page = Page::create([
            'title' => 'Original Title',
            'slug' => 'original-slug',
            'in_navbar' => false,
            'navbar_order' => 2,
            'is_published' => true,
        ]);

        $section = PageSection::create([
            'page_id' => $page->id,
            'section_key' => 'hero',
            'section_name' => 'Hero Section',
            'order' => 1,
            'is_active' => true,
            'content' => ['title' => 'Old Title'],
        ]);

        $response = $this->actingAs($user)->put("/admin/pages/{$page->id}", [
            'title' => 'Updated Title',
            'slug' => 'updated-slug',
            'navbar_order' => 5,
            'in_navbar' => '1',
            'is_published' => '1',
            'meta_title' => 'SEO Title',
            'sections' => [
                'hero' => [
                    'is_active' => '1',
                    'content' => [
                        'title' => 'New Dynamic Hero Title',
                    ],
                ],
            ],
        ]);

        $response->assertRedirect("/admin/pages/{$page->id}/edit?tab=general");
        $this->assertDatabaseHas('pages', ['id' => $page->id, 'title' => 'Updated Title', 'in_navbar' => 1]);
        
        $section->refresh();
        $this->assertEquals('New Dynamic Hero Title', $section->get('title'));
    }

    public function test_admin_can_toggle_navbar_and_published(): void
    {
        $user = User::factory()->create();
        $page = Page::create([
            'title' => 'Toggle Page',
            'slug' => 'toggle-page',
            'in_navbar' => false,
            'is_published' => false,
        ]);

        $this->actingAs($user)->patch("/admin/pages/{$page->id}/toggle-navbar");
        $page->refresh();
        $this->assertTrue($page->in_navbar);

        $this->actingAs($user)->patch("/admin/pages/{$page->id}/toggle-published");
        $page->refresh();
        $this->assertTrue($page->is_published);
    }

    public function test_admin_can_update_and_delete_overview_communities_dynamically(): void
    {
        $user = User::factory()->create();
        $page = Page::create([
            'title' => 'Home',
            'slug' => '/',
            'in_navbar' => true,
            'navbar_order' => 1,
            'is_published' => true,
        ]);

        $section = PageSection::create([
            'page_id' => $page->id,
            'section_key' => 'content',
            'section_name' => 'Content',
            'order' => 3,
            'is_active' => true,
            'content' => [
                'html' => '<h2>Hudayriyat Communities</h2><p>Pre-filled website content inside single Summernote editor.</p>',
            ],
        ]);

        // Verify editor displays the single Summernote editor with pre-filled content
        $editResponse = $this->actingAs($user)->get("/admin/pages/{$page->id}/edit?tab=content");
        $editResponse->assertStatus(200);
        $editResponse->assertSee('Content Editor');
        $editResponse->assertSee('Hudayriyat Communities');
        $editResponse->assertSee('Pre-filled website content inside single Summernote editor.');

        // Update content via Summernote
        $updatedHtml = '<h2>Updated Communities Heading</h2><p>Live updated editorial content with new images and paragraphs.</p>';
        $updateResponse = $this->actingAs($user)->put("/admin/pages/{$page->id}", [
            'title' => 'Home',
            'slug' => '/',
            'sections' => [
                'content' => [
                    'html' => $updatedHtml,
                ],
            ],
        ]);

        $updateResponse->assertRedirect();
        $section->refresh();

        $this->assertStringContainsString('id="updated-communities-heading"', $section->content['html']);
        $this->assertStringContainsString('Updated Communities Heading', $section->content['html']);

        // Check public home page reflects dynamic content live
        $homeResponse = $this->get('/');
        $homeResponse->assertStatus(200);
        $homeResponse->assertSee('Updated Communities Heading');
        $homeResponse->assertSee('Live updated editorial content with new images and paragraphs.');
    }

    public function test_cms_update_automatically_injects_heading_ids_for_toc_scroll(): void
    {
        $user = User::factory()->create();
        $page = Page::firstOrCreate(['slug' => 'wadeem-gardens'], ['title' => 'Wadeem Gardens', 'is_published' => true]);

        $section = PageSection::firstOrCreate(
            ['page_id' => $page->id, 'section_key' => 'content'],
            ['section_name' => 'Content', 'order' => 5, 'content' => []]
        );

        // Simulate admin submitting Summernote HTML with raw <h2> tags that lack ID attributes
        $summernoteHtml = '<h2>About the Developers</h2><p>Overview details...</p><h2 class="subhead">Saima Mangrove Residences NOC</h2><p>NOC info...</p>';

        $response = $this->actingAs($user)->put("/admin/pages/{$page->id}", [
            'title' => 'Wadeem Gardens',
            'slug' => 'wadeem-gardens',
            'sections' => [
                'content' => [
                    'html' => $summernoteHtml,
                ],
            ],
        ]);

        $response->assertRedirect();
        $section->refresh();

        // Verify IDs were automatically injected
        $this->assertStringContainsString('id="about-the-developers"', $section->content['html']);
        $this->assertStringContainsString('id="saima-mangrove-residences-noc"', $section->content['html']);
    }

    public function test_admin_can_update_home_page_special_sections_and_images(): void
    {
        $user = User::factory()->create();
        $page = Page::firstOrCreate(['slug' => '/'], ['title' => 'Home', 'is_published' => true]);

        $locSection = PageSection::firstOrCreate(
            ['page_id' => $page->id, 'section_key' => 'overview_location'],
            ['section_name' => 'Overview & Location', 'order' => 6, 'content' => []]
        );
        $faqSection = PageSection::firstOrCreate(
            ['page_id' => $page->id, 'section_key' => 'faq'],
            ['section_name' => 'FAQ', 'order' => 8, 'content' => []]
        );

        $fakeImage = \Illuminate\Http\UploadedFile::fake()->create('custom-location.jpg', 100, 'image/jpeg');

        $updateResponse = $this->actingAs($user)->put("/admin/pages/{$page->id}", [
            'title' => 'Home',
            'slug' => '/',
            'sections' => [
                'overview_location' => [
                    '_has_locations' => '1',
                    'heading' => 'Dynamic Hudayriyat Overview Title',
                    'paragraphs' => "Custom first paragraph.\n\nCustom second paragraph.",
                    'image' => '/images/hudayriyat-overview.jpg',
                    'image_alt' => 'Updated Alt Text',
                    'locations' => [
                        0 => ['name' => 'Downtown Dubai', 'distance' => '50 minutes by car'],
                    ],

                ],
                'faq' => [
                    '_has_items' => '1',
                    'heading' => 'Dynamic Answers & Questions',
                    'subtitle' => 'Instant FAQs',
                    'items' => [
                        0 => ['q' => 'Can foreigners buy property in Hudayriyat?', 'a' => 'Yes, freehold ownership is available for select nationalities.'],
                    ],
                ],
            ],
            'section_files' => [
                'overview_location' => [
                    'image' => $fakeImage,
                ],
            ],
        ]);

        $updateResponse->assertRedirect();

        $locSection->refresh();
        $this->assertEquals('Dynamic Hudayriyat Overview Title', $locSection->get('heading'));
        $this->assertStringContainsString('/uploads/pages/', $locSection->get('image'));
        $this->assertCount(1, $locSection->get('locations'));
        $this->assertEquals('Downtown Dubai', $locSection->get('locations')[0]['name']);


        $faqSection->refresh();
        $this->assertEquals('Dynamic Answers & Questions', $faqSection->get('heading'));
        $this->assertEquals('Can foreigners buy property in Hudayriyat?', $faqSection->get('items')[0]['q']);

        // Assert public home page renders these dynamic sections
        $homeResponse = $this->get('/');
        $homeResponse->assertStatus(200);
        $homeResponse->assertSee('Dynamic Hudayriyat Overview Title');
        $homeResponse->assertSee('Downtown Dubai');

        $homeResponse->assertSee('Dynamic Answers & Questions');
        $homeResponse->assertSee('Can foreigners buy property in Hudayriyat?');
    }

    public function test_admin_can_update_hero_background_image(): void
    {
        $user = User::factory()->create();
        $page = Page::create([
            'title' => 'Home',
            'slug' => '/',
            'in_navbar' => true,
            'navbar_order' => 1,
            'is_published' => true,
        ]);

        $heroSection = PageSection::create([
            'page_id' => $page->id,
            'section_key' => 'hero',
            'section_name' => 'Hero Banner',
            'order' => 1,
            'is_active' => true,
            'content' => [
                'title' => "Hudayriyat\nIsland",
                'subtitle' => "Abu Dhabi Lifestyle",
                'badge' => 'Freehold',
                'bg_image' => '/images/hero/slide-1.jpg',
                'bg_image_alt' => 'Initial Hero Alt Text',
            ],
        ]);

        // 1. Verify editor displays current bg image and alt text field
        $editResponse = $this->actingAs($user)->get("/admin/pages/{$page->id}/edit?tab=hero");
        $editResponse->assertStatus(200);
        $editResponse->assertSee('/images/hero/slide-1.jpg');
        $editResponse->assertSee('Hero Image Alt Text (SEO)');
        $editResponse->assertSee('Initial Hero Alt Text');

        // 2. Upload custom hero bg image and custom alt text
        $fakeHeroImage = \Illuminate\Http\UploadedFile::fake()->create('custom-hero-bg.jpg', 200, 'image/jpeg');

        $updateResponse = $this->actingAs($user)->put("/admin/pages/{$page->id}", [
            'title' => 'Home',
            'slug' => '/',
            'sections' => [
                'hero' => [
                    'title' => 'Dynamic Hero Title',
                    'subtitle' => 'Dynamic Hero Subtitle',
                    'badge' => 'Freehold Luxury',
                    'bg_image' => '/images/hero/slide-1.jpg',
                    'bg_image_alt' => 'Custom SEO Optimized Hero Image Alt Text',
                ],
            ],
            'section_files' => [
                'hero' => [
                    'bg_image' => $fakeHeroImage,
                ],
            ],
        ]);

        $updateResponse->assertRedirect();

        $heroSection->refresh();
        $this->assertEquals('Dynamic Hero Title', $heroSection->get('title'));
        $this->assertEquals('Custom SEO Optimized Hero Image Alt Text', $heroSection->get('bg_image_alt'));
        $this->assertStringContainsString('/uploads/pages/', $heroSection->get('bg_image'));

        // Assert public home page renders the uploaded dynamic background and dynamic alt text in img tag
        $homeResponse = $this->get('/');
        $homeResponse->assertStatus(200);
        $homeResponse->assertSee($heroSection->get('bg_image'));
        $homeResponse->assertSee('alt="Custom SEO Optimized Hero Image Alt Text"', false);
        // Assert H1 tag wraps the hero main heading
        $homeResponse->assertSee('<h1 class="heroTitle">', false);
        $homeResponse->assertSee('Dynamic Hero Title');
    }

    public function test_admin_can_reorder_sections_via_drag_and_drop(): void
    {
        $user = User::factory()->create();
        $page = Page::create([
            'title' => 'Home',
            'slug' => '/',
            'in_navbar' => true,
            'navbar_order' => 1,
            'is_published' => true,
        ]);

        $secHero = PageSection::create([
            'page_id' => $page->id,
            'section_key' => 'hero',
            'section_name' => 'Hero Banner',
            'order' => 1,
            'is_active' => true,
            'content' => ['title' => 'Hero Title'],
        ]);

        $secHighlights = PageSection::create([
            'page_id' => $page->id,
            'section_key' => 'highlights',
            'section_name' => 'Project Highlights',
            'order' => 2,
            'is_active' => true,
            'content' => ['developer' => 'Modon'],
        ]);

        $secCommunities = PageSection::create([
            'page_id' => $page->id,
            'section_key' => 'communities',
            'section_name' => 'Featured Communities',
            'order' => 3,
            'is_active' => true,
            'content' => ['heading' => 'Communities Heading'],
        ]);

        // Drag & drop reorder: move communities first, then highlights, then hero
        $response = $this->actingAs($user)->postJson("/admin/pages/{$page->id}/reorder-sections", [
            'order' => ['communities', 'highlights', 'hero'],
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $secCommunities->refresh();
        $secHighlights->refresh();
        $secHero->refresh();

        $this->assertEquals(1, $secCommunities->order);
        $this->assertEquals(2, $secHighlights->order);
        $this->assertEquals(3, $secHero->order);

        // Public home page renders communities before hero
        $homeResponse = $this->get('/');
        $homeResponse->assertStatus(200);
        $content = $homeResponse->getContent();
        $posCommunities = strpos($content, 'Communities Heading');
        $posHero = strpos($content, 'Hero Title');
        $this->assertTrue($posCommunities < $posHero, 'Communities should render before Hero on home page');
    }

    public function test_admin_can_crud_investment_highlights_and_financing_options(): void
    {
        $user = User::factory()->create();
        $page = Page::create([
            'title' => 'Home',
            'slug' => '/',
            'in_navbar' => true,
            'navbar_order' => 1,
            'is_published' => true,
        ]);

        $section = PageSection::create([
            'page_id' => $page->id,
            'section_key' => 'investment',
            'section_name' => 'Investment & Financing',
            'order' => 4,
            'is_active' => true,
            'content' => [
                'heading' => 'Investment Potential Test',
                'location_badge' => 'Hudayriyat Island, Abu Dhabi',
                'description' => 'Original description test',
                'highlights_heading' => 'Key Investment Highlights:',
                'investment_highlights' => [
                    ['text' => 'First investment highlight'],
                    ['text' => 'Second investment highlight'],
                ],
                'cta' => 'Contact Consultant Test',
                'financing_title' => 'Flexible Financing Options Test',
                'financing_desc' => 'Financing desc test',
                'financing_highlights' => [
                    ['text' => 'First financing point'],
                    ['text' => 'Second financing point'],
                ],
                'financing_cta' => 'Contact Mortgage Specialist Test',
            ],
        ]);

        // Editor view shows the highlights
        $editResponse = $this->actingAs($user)->get("/admin/pages/{$page->id}/edit?tab=investment");
        $editResponse->assertStatus(200);
        $editResponse->assertSee('Key Investment Highlights:');
        $editResponse->assertSee('First investment highlight');
        $editResponse->assertSee('First financing point');
        $editResponse->assertSee('Contact Mortgage Specialist Test');

        // Update via Admin: edit bullets, add one, delete one
        $updateResponse = $this->actingAs($user)->put("/admin/pages/{$page->id}", [
            'title' => 'Home',
            'slug' => '/',
            'active_tab' => 'investment',
            'sections' => [
                'investment' => [
                    'is_active' => '1',
                    'content' => [
                        'heading' => 'Updated Investment Heading',
                        'location_badge' => 'Updated Badge',
                        'description' => 'Updated Investment Description',
                        'highlights_heading' => 'Custom Investment Highlights Title:',
                        'cta' => 'New Consultant CTA',
                        'financing_title' => 'New Financing Title',
                        'financing_desc' => 'New Financing Description',
                        'financing_cta' => 'New Mortgage CTA',
                        '_has_investment_highlights' => '1',
                        'investment_highlights' => [
                            ['text' => 'Brand New Custom Highlight A'],
                            ['text' => 'Brand New Custom Highlight B'],
                            ['text' => 'Brand New Custom Highlight C'],
                        ],
                        '_has_financing_highlights' => '1',
                        'financing_highlights' => [
                            ['text' => 'Custom Bank Financing Bullet 1'],
                        ],
                    ],
                ],
            ],
        ]);

        $updateResponse->assertRedirect("/admin/pages/{$page->id}/edit?tab=investment");

        $section->refresh();
        $this->assertEquals('Updated Investment Heading', $section->get('heading'));
        $this->assertEquals('Custom Investment Highlights Title:', $section->get('highlights_heading'));
        $this->assertEquals('New Mortgage CTA', $section->get('financing_cta'));
        $this->assertCount(3, $section->get('investment_highlights'));
        $this->assertEquals('Brand New Custom Highlight A', $section->get('investment_highlights')[0]['text']);
        $this->assertCount(1, $section->get('financing_highlights'));
        $this->assertEquals('Custom Bank Financing Bullet 1', $section->get('financing_highlights')[0]['text']);

        // Verify public home page reflects dynamic changes
        $homeResponse = $this->get('/');
        $homeResponse->assertStatus(200);
        $homeResponse->assertSee('Updated Investment Heading');
        $homeResponse->assertSee('Custom Investment Highlights Title:');
        $homeResponse->assertSee('Brand New Custom Highlight A');
        $homeResponse->assertSee('Brand New Custom Highlight B');
        $homeResponse->assertSee('Brand New Custom Highlight C');
        $homeResponse->assertSee('Custom Bank Financing Bullet 1');
        $homeResponse->assertSee('New Mortgage CTA');
    }

    public function test_admin_can_crud_about_us_and_contact_us_dynamically(): void
    {
        $user = User::factory()->create();

        // 1. Seed PageSeeder
        $this->seed(\Database\Seeders\PageSeeder::class);

        $aboutPage = Page::where('slug', 'about-us')->firstOrFail();
        $contactPage = Page::where('slug', 'contact-us')->firstOrFail();

        // 2. Verify editor renders about-us tabs
        $editAbout = $this->actingAs($user)->get("/admin/pages/{$aboutPage->id}/edit?tab=services");
        $editAbout->assertStatus(200);
        $editAbout->assertSee('Core Services');
        $editAbout->assertSee('Property Advisory');

        // 3. Update About Us via CMS PUT
        $updateAbout = $this->actingAs($user)->put("/admin/pages/{$aboutPage->id}", [
            'title' => 'About Us Dynamic',
            'slug' => 'about-us',
            'active_tab' => 'services',
            'sections' => [
                'hero' => [
                    'badge' => 'CUSTOM ABOUT BADGE',
                    'title' => 'Dynamic About Us Title',
                    'subtitle' => 'Dynamic Subtitle Description',
                ],
                'services' => [
                    'tag' => 'DYNAMIC SERVICES TAG',
                    'heading' => 'Custom Services Heading',
                    '_has_items' => '1',
                    'items' => [
                        ['title' => 'Custom VIP Advisory', 'icon' => 'compass', 'description' => 'Tailored VIP service description.'],
                    ],
                ],
            ],
        ]);
        $updateAbout->assertRedirect("/admin/pages/{$aboutPage->id}/edit?tab=services");

        // Verify public /about-us reflects dynamic updates
        $publicAbout = $this->get('/about-us');
        $publicAbout->assertStatus(200);
        $publicAbout->assertSee('CUSTOM ABOUT BADGE');
        $publicAbout->assertSee('Dynamic About Us Title');
        $publicAbout->assertSee('DYNAMIC SERVICES TAG');
        $publicAbout->assertSee('Custom Services Heading');
        $publicAbout->assertSee('Custom VIP Advisory');

        // 4. Update Contact Us via CMS PUT
        $updateContact = $this->actingAs($user)->put("/admin/pages/{$contactPage->id}", [
            'title' => 'Contact Us Dynamic',
            'slug' => 'contact-us',
            'active_tab' => 'channels',
            'sections' => [
                'hero' => [
                    'badge' => 'CUSTOM CONTACT BADGE',
                    'title' => 'Dynamic Contact Title',
                    'subtitle' => 'Reach out anytime.',
                ],
                'channels' => [
                    '_has_items' => '1',
                    'items' => [
                        [
                            'title' => 'VIP Concierge WhatsApp',
                            'icon' => 'whatsapp',
                            'info' => '+971 55 123 4567',
                            'action' => 'Chat with VIP Concierge →',
                            'url' => 'https://wa.me/971551234567',
                        ],
                    ],
                ],
            ],
        ]);
        $updateContact->assertRedirect("/admin/pages/{$contactPage->id}/edit?tab=channels");

        // Verify public /contact-us reflects dynamic updates
        $publicContact = $this->get('/contact-us');
        $publicContact->assertStatus(200);
        $publicContact->assertSee('CUSTOM CONTACT BADGE');
        $publicContact->assertSee('Dynamic Contact Title');
        $publicContact->assertSee('VIP Concierge WhatsApp');
        $publicContact->assertSee('+971 55 123 4567');
        $publicContact->assertSee('Chat with VIP Concierge →');
    }

    public function test_admin_can_crud_legal_pages_dynamically(): void
    {
        $this->seed(\Database\Seeders\PageSeeder::class);
        $user = User::factory()->create();

        // 1. Privacy Policy
        $privacyPage = Page::where('slug', 'privacy-policy')->firstOrFail();
        $this->actingAs($user)->get("/admin/pages/{$privacyPage->id}/edit")
            ->assertStatus(200)
            ->assertSee('Privacy Policy');

        $updatePrivacy = $this->actingAs($user)->put("/admin/pages/{$privacyPage->id}", [
            'title' => 'Privacy Policy',
            'slug' => 'privacy-policy',
            'sections' => [
                'hero' => [
                    'badge' => 'CUSTOM PRIVACY BADGE 2026',
                    'title' => 'Updated Privacy Charter',
                    'subtitle' => 'Our updated commitment to your privacy.',
                ],
                'policy_content' => [
                    '_has_items' => '1',
                    'items' => [
                        [
                            'title' => 'Dynamic Data Governance',
                            'description' => 'Zero third-party telemetry is allowed on our client records.',
                        ],
                    ],
                ],
            ],
        ]);
        $updatePrivacy->assertRedirect();

        $publicPrivacy = $this->get('/privacy-policy');
        $publicPrivacy->assertStatus(200);
        $publicPrivacy->assertSee('CUSTOM PRIVACY BADGE 2026');
        $publicPrivacy->assertSee('Updated Privacy Charter');
        $publicPrivacy->assertSee('Dynamic Data Governance');
        $publicPrivacy->assertSee('Zero third-party telemetry is allowed on our client records.');

        // 2. Terms & Conditions
        $termsPage = Page::where('slug', 'terms-and-conditions')->firstOrFail();
        $updateTerms = $this->actingAs($user)->put("/admin/pages/{$termsPage->id}", [
            'title' => 'Terms & Conditions',
            'slug' => 'terms-and-conditions',
            'sections' => [
                'hero' => [
                    'badge' => 'LEGAL MASTER TERMS',
                    'title' => 'Client Engagement Terms',
                    'subtitle' => 'Guidelines governing private viewings and bookings.',
                ],
                'terms_content' => [
                    '_has_items' => '1',
                    'items' => [
                        [
                            'title' => 'Private Viewing Protocol',
                            'description' => 'All villa visits must be scheduled with a certified representative.',
                        ],
                    ],
                ],
            ],
        ]);
        $updateTerms->assertRedirect();

        $publicTerms = $this->get('/terms-and-conditions');
        $publicTerms->assertStatus(200);
        $publicTerms->assertSee('LEGAL MASTER TERMS');
        $publicTerms->assertSee('Client Engagement Terms');
        $publicTerms->assertSee('Private Viewing Protocol');
        $publicTerms->assertSee('All villa visits must be scheduled with a certified representative.');

        // 3. Disclaimer
        $discPage = Page::where('slug', 'disclaimer')->firstOrFail();
        $updateDisc = $this->actingAs($user)->put("/admin/pages/{$discPage->id}", [
            'title' => 'Disclaimer',
            'slug' => 'disclaimer',
            'sections' => [
                'hero' => [
                    'badge' => 'OFFICIAL DISCLOSURE 2026',
                    'title' => 'Property Accuracy Notice',
                    'subtitle' => 'Official details regarding architectural representations.',
                ],
                'disclaimer_content' => [
                    '_has_items' => '1',
                    'items' => [
                        [
                            'title' => 'Architectural Renders & Models',
                            'description' => 'Artistic impressions are subject to final developer construction adjustments.',
                        ],
                    ],
                ],
            ],
        ]);
        $updateDisc->assertRedirect();

        $publicDisc = $this->get('/disclaimer');
        $publicDisc->assertStatus(200);
        $publicDisc->assertSee('OFFICIAL DISCLOSURE 2026');
        $publicDisc->assertSee('Property Accuracy Notice');
        $publicDisc->assertSee('Architectural Renders & Models');
        $publicDisc->assertSee('Artistic impressions are subject to final developer construction adjustments.');
    }

    public function test_admin_can_crud_community_pages_dynamically(): void
    {
        $this->seed(\Database\Seeders\PageSeeder::class);
        $user = User::factory()->create();

        // 1. Check projects index shows registered community sections
        $indexResponse = $this->actingAs($user)->get('/admin/projects');
        $indexResponse->assertStatus(200);
        $indexResponse->assertSee('Wadeem Gardens');
        $indexResponse->assertSee('Hudayriyat Golf Estates');
        $indexResponse->assertSee('2 sections');

        // 2. Open community editor
        $wadeemPage = Page::where('slug', 'wadeem-gardens')->firstOrFail();
        $editResponse = $this->actingAs($user)->get("/admin/pages/{$wadeemPage->id}/edit");
        $editResponse->assertStatus(200);
        $editResponse->assertSee('Hero Banner Content');
        $editResponse->assertSee('Project Highlights');
        $editResponse->assertSee('Amenities');

        // 3. Update Wadeem Gardens via CMS PUT
        $updateResponse = $this->actingAs($user)->put("/admin/pages/{$wadeemPage->id}", [
            'title' => 'Wadeem Gardens Custom',
            'slug' => 'wadeem-gardens',
            'sections' => [
                'hero' => [
                    'badge' => 'CUSTOM VIP BADGE 2026',
                    'title' => 'Wadeem Gardens Master Residences',
                    'subtitle' => 'Custom dynamic waterfront living description.',
                    'bg_image' => '/images/custom-wadeem-hero.jpg',
                ],
                'highlights' => [
                    '_has_items' => '1',
                    'items' => [
                        ['label' => 'Custom Handover', 'value' => 'December 2032'],
                        ['label' => 'Starting Price From', 'value' => 'AED 9,500,000'],
                    ],
                ],
            ],
        ]);
        $updateResponse->assertRedirect();

        // 4. Assert public /wadeem-gardens renders the dynamic changes
        $publicWadeem = $this->get('/wadeem-gardens');
        $publicWadeem->assertStatus(200);
        $publicWadeem->assertSee('CUSTOM VIP BADGE 2026');
        $publicWadeem->assertSee('Wadeem Gardens Master Residences');
        $publicWadeem->assertSee('Custom dynamic waterfront living description.');
        $publicWadeem->assertSee('/images/custom-wadeem-hero.jpg');
        $publicWadeem->assertSee('Custom Handover');
        $publicWadeem->assertSee('December 2032');
        $publicWadeem->assertSee('Starting Price From');
        $publicWadeem->assertSee('AED 9,500,000');
    }

    public function test_admin_can_create_page_with_global_sections(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/admin/pages', [
            'title'           => 'Marina Bay Residences',
            'slug'            => 'marina-bay-residences',
            'page_type'       => 'global',
            'global_sections' => ['highlights', 'about', 'amenities', 'contact', 'toc'],
            'in_navbar'       => '1',
            'is_published'    => '1',
        ]);

        $page = Page::where('slug', 'marina-bay-residences')->first();
        $this->assertNotNull($page);
        $this->assertEquals('Marina Bay Residences', $page->title);
        $this->assertTrue($page->in_navbar);
        $this->assertTrue($page->is_published);

        $response->assertRedirect("/admin/pages/{$page->id}/edit");

        // Verify attached global sections (hero is automatically prepended + chosen ones)
        $sectionKeys = $page->sections()->pluck('section_key')->toArray();
        $this->assertContains('hero', $sectionKeys);
        $this->assertContains('highlights', $sectionKeys);
        $this->assertContains('about', $sectionKeys);
        $this->assertContains('amenities', $sectionKeys);
        $this->assertContains('contact', $sectionKeys);
        $this->assertContains('toc', $sectionKeys);
    }

    public function test_admin_can_create_custom_page_with_full_section_builder_and_render_publicly(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/admin/pages', [
            'title'        => 'Sunset Cliff Villas',
            'slug'         => 'sunset-cliff-villas',
            'page_type'    => 'custom',
            'in_navbar'    => '1',
            'is_published' => '1',
        ]);

        $page = Page::where('slug', 'sunset-cliff-villas')->first();
        $this->assertNotNull($page);
        $response->assertRedirect("/admin/pages/{$page->id}/edit");

        // All 12 standard sections are pre-populated with defaults
        $sectionKeys = $page->sections()->pluck('section_key')->toArray();
        $this->assertContains('hero', $sectionKeys);
        $this->assertContains('highlights', $sectionKeys);
        $this->assertContains('about', $sectionKeys);
        $this->assertContains('amenities', $sectionKeys);
        $this->assertContains('gallery', $sectionKeys);
        $this->assertContains('floor_plans', $sectionKeys);
        $this->assertContains('payment_plan', $sectionKeys);
        $this->assertNotContains('payment_methods', $sectionKeys);
        $this->assertContains('faq', $sectionKeys);
        $this->assertContains('master_plan', $sectionKeys);
        $this->assertContains('contact', $sectionKeys);
        $this->assertContains('location', $sectionKeys);

        // Check that pre-populated content exists
        $aboutSec = $page->section('about');
        $this->assertNotNull($aboutSec);
        $this->assertStringContainsString('Sunset Cliff Villas', $aboutSec->field('description'));

        // Test public dynamic page rendering
        $publicRes = $this->get('/sunset-cliff-villas');
        $publicRes->assertStatus(200);
        $publicRes->assertSee('Sunset Cliff Villas');
        $publicRes->assertSee('Amenities');
        $publicRes->assertSee('Payment Plan');
        $publicRes->assertSee('Frequently Asked Questions');
    }

    public function test_admin_can_delete_custom_page(): void
    {
        $user = User::factory()->create();

        $page = Page::create([
            'title' => 'Temporary Page',
            'slug' => 'temp-page',
            'is_published' => false,
        ]);

        PageSection::create([
            'page_id' => $page->id,
            'section_key' => 'hero',
            'section_name' => 'Hero',
            'order' => 1,
            'is_active' => true,
            'content' => ['title' => 'Temp Hero'],
        ]);

        $delResponse = $this->actingAs($user)->delete("/admin/pages/{$page->id}");
        $delResponse->assertRedirect('/admin/pages');

        $this->assertDatabaseMissing('pages', ['id' => $page->id]);
        $this->assertDatabaseMissing('page_sections', ['page_id' => $page->id]);
    }

    public function test_admin_can_add_page_with_hero_section_and_summernote_content(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/admin/pages', [
            'title' => 'Marina Cove Residences',
            'slug' => 'marina-cove-residences',
            'in_navbar' => 1,
            'is_published' => 1,
            'has_hero' => 1,
            'hero_title' => 'Marina Cove Waterfront Sanctuary',
            'hero_subtitle' => 'Exclusive Luxury Marina Living on Hudayriyat Island',
            'hero_badge' => 'Freehold for All Nationalities',
            'hero_bg_image' => '/hero.png',
            'hero_content' => '<h2>Welcome to Marina Cove</h2><p>Pre-populated Summernote editorial description.</p>',
        ]);

        $page = Page::where('slug', 'marina-cove-residences')->first();
        $this->assertNotNull($page);
        $response->assertRedirect("/admin/pages/{$page->id}/edit");

        $heroSection = $page->sections()->where('section_key', 'hero')->first();
        $this->assertNotNull($heroSection);
        $this->assertEquals('Marina Cove Waterfront Sanctuary', $heroSection->field('title'));
        $this->assertEquals('/hero.png', $heroSection->field('bg_image'));

        $this->assertStringContainsString('Marina Cove', $page->body);
    }

    public function test_admin_can_create_page_with_two_tabs_highlights_and_custom_icons_with_drag_drop_order(): void
    {
        $admin = User::first();
        if (!$admin) {
            $admin = User::factory()->create(['role' => 'admin']);
        }

        $response = $this->actingAs($admin)->post('/admin/pages', [
            'title' => 'Nawayef Heights Community',
            'slug' => 'nawayef-heights-community',
            'in_navbar' => 1,
            'is_published' => 1,
            'has_hero' => 1,
            'hero_title' => 'Nawayef Heights Waterfront Haven',
            'hero_subtitle' => 'Elevated luxury on the cliffs of Hudayriyat',
            'hero_badge' => 'Freehold for All Nationalities',
            'hero_bg_image' => '/images/hero/slide-1.jpg',
            'hero_content' => '<h2>Nawayef Heights</h2><p>Panoramic luxury living.</p>',
            'has_highlights' => 1,
            'highlights_title' => 'Nawayef Highlights',
            'highlights_items' => [
                ['label' => 'Developer', 'value' => 'Modon Properties', 'icon' => 'building'],
                ['label' => 'Price', 'value' => 'AED 6,200,000', 'icon' => 'tag'],
                ['label' => 'Handover Date', 'value' => 'Q4 2029', 'icon' => 'calendar'],
                ['label' => 'Property Type', 'value' => 'Luxury Mansions', 'icon' => 'home'],
                ['label' => 'Ownership', 'value' => 'Freehold', 'icon' => 'shield'],
            ],
            'section_order' => json_encode(['highlights', 'hero']),
        ]);

        $page = Page::where('slug', 'nawayef-heights-community')->first();
        $this->assertNotNull($page);
        $response->assertRedirect("/admin/pages/{$page->id}/edit");

        // Verify sections and order
        $sections = $page->sections()->orderBy('order')->get();
        $this->assertCount(3, $sections); // highlights, hero, content

        $firstSection = $sections->first();
        $this->assertEquals('highlights', $firstSection->section_key);
        $this->assertEquals(1, $firstSection->order);
        $this->assertEquals('Nawayef Highlights', $firstSection->field('title'));

        $items = $firstSection->field('items');
        $this->assertIsArray($items);
        $this->assertEquals('AED 6,200,000', $items[1]['value']);
        $this->assertEquals('tag', $items[1]['icon']);

        $secondSection = $sections[1];
        $this->assertEquals('hero', $secondSection->section_key);
        $this->assertEquals(2, $secondSection->order);

        // Verify dynamic page renders highlights BEFORE hero, and does NOT render unselected sections
        $html = view('dynamic-page', compact('page'))->render();
        $this->assertStringContainsString('Nawayef Heights Waterfront Haven', $html);
        $this->assertStringContainsString('AED 6,200,000', $html);
        $this->assertStringNotContainsString('GolfAmenities-module', $html);
        $this->assertStringNotContainsString('GolfFloorPlans-module', $html);

        $hlPos = strpos($html, 'GolfHighlights-module');
        $heroPos = strpos($html, 'GolfHero-module');
        $this->assertLessThan($heroPos, $hlPos);
    }
}

