<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SitemapLiveDomainTest extends TestCase
{
    use RefreshDatabase;
    public function test_sitemap_index_picks_live_domain_automatically(): void
    {
        $response = $this->get('https://saimaprojects.com/sitemap.xml');

        $response->assertStatus(200);
        $content = $response->getContent();

        // Must contain live domain
        $this->assertStringContainsString('https://saimaprojects.com/sitemap/page-sitemap.xml', $content);
        $this->assertStringContainsString('https://saimaprojects.com/sitemap/project-sitemap.xml', $content);

        // Must NOT contain localhost
        $this->assertStringNotContainsString('localhost', $content);
        $this->assertStringNotContainsString('127.0.0.1', $content);
    }

    public function test_page_sitemap_picks_live_domain(): void
    {
        $response = $this->get('https://saimaprojects.com/sitemap/page-sitemap.xml');

        $response->assertStatus(200);
        $content = $response->getContent();

        $this->assertStringContainsString('https://saimaprojects.com/', $content);
        $this->assertStringContainsString('https://saimaprojects.com/contact-us', $content);
        $this->assertStringNotContainsString('localhost', $content);
    }

    public function test_ignores_polluted_localhost_in_database_settings(): void
    {
        // Simulate database setting containing http://localhost:8001 or http://localhost:8000
        \App\Models\SiteSetting::set('seo_canonical_url', 'http://localhost:8001', 'string', 'seo');

        $response = $this->get('https://saimaprojects.com/sitemap.xml');
        $response->assertStatus(200);
        $content = $response->getContent();

        // Must still emit live domain
        $this->assertStringContainsString('https://saimaprojects.com/sitemap/page-sitemap.xml', $content);
        $this->assertStringNotContainsString('localhost:8001', $content);
        $this->assertStringNotContainsString('localhost', $content);
    }

    public function test_local_dev_url_works_on_localhost(): void
    {
        $response = $this->get('http://127.0.0.1:8000/sitemap.xml');
        $response->assertStatus(200);
        $content = $response->getContent();

        $this->assertStringContainsString('http://127.0.0.1:8000/sitemap/page-sitemap.xml', $content);
    }
}
