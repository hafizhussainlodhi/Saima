<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\City;
use App\Models\Community;
use App\Models\Page;
use App\Models\Project;
use App\Models\SiteSetting;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Helper to determine base URL dynamically from current request or app configuration.
     * Automatically picks up the live domain (url('/') or config('app.url')) and avoids localhost on live server.
     */
    protected function getBaseUrl(): string
    {
        // 1. If running under an active HTTP request, automatically pick up the live domain
        if (app()->bound('request') && request()->getHost()) {
            $root = rtrim(request()->root() ?: url('/'), '/');

            // Force HTTPS if request is secure, or behind an HTTPS proxy (Cloudflare, Nginx, AWS ALB) or if app.url is HTTPS
            $isHttps = request()->isSecure()
                || strtolower((string) request()->header('x-forwarded-proto')) === 'https'
                || strtolower((string) request()->server('HTTP_X_FORWARDED_PROTO')) === 'https'
                || strtolower((string) request()->header('x-forwarded-ssl')) === 'on'
                || str_starts_with((string) config('app.url'), 'https://');

            if ($isHttps && str_starts_with($root, 'http://')) {
                $root = 'https://' . substr($root, 7);
            }

            // If the live request domain is active and NOT localhost/127.0.0.1, use it directly
            if (!empty($root) && !str_contains($root, 'localhost') && !str_contains($root, '127.0.0.1')) {
                return $root;
            }
        }

        // 2. Check config('app.url') if configured with a valid domain (and not localhost)
        $configUrl = config('app.url');
        if (!empty($configUrl) && filter_var($configUrl, FILTER_VALIDATE_URL)) {
            $cleanConfigUrl = rtrim($configUrl, '/');
            if (!str_contains($cleanConfigUrl, 'localhost') && !str_contains($cleanConfigUrl, '127.0.0.1')) {
                return $cleanConfigUrl;
            }
        }

        // 3. Fallback to canonical SEO setting ONLY if it is a valid non-localhost URL
        $canonicalSetting = SiteSetting::get('seo_canonical_url');
        if (!empty($canonicalSetting) && filter_var($canonicalSetting, FILTER_VALIDATE_URL)) {
            $cleanCanonical = rtrim($canonicalSetting, '/');
            if (!str_contains($cleanCanonical, 'localhost') && !str_contains($cleanCanonical, '127.0.0.1')) {
                return $cleanCanonical;
            }
        }

        // 4. Default fallback: use url('/') or config('app.url') (supports local dev on localhost)
        $fallback = rtrim(url('/'), '/');
        if (!empty($fallback)) {
            return $fallback;
        }

        return rtrim((string) (config('app.url') ?: 'https://saimaprojects.com'), '/');
    }

    /**
     * Helper to format ISO 8601 timestamp with milliseconds UTC (e.g. 2026-08-04T06:52:44.914Z)
     */
    protected function formatDate($date): string
    {
        if (!$date) {
            return now()->toISOString();
        }
        if ($date instanceof \Carbon\CarbonInterface) {
            return $date->toISOString();
        }
        return \Carbon\Carbon::parse($date)->toISOString();
    }

    /**
     * Root /sitemap.xml:
     * Outputs the index of all sub-sitemaps:
     * 1. page-sitemap.xml
     * 2. project-sitemap.xml
     * 3. city-sitemap.xml
     * 4. area-sitemap.xml
     * 5. blog-sitemap.xml
     * 6. dynamic-sitemap.xml
     */
    public function index(): Response
    {
        $baseUrl = $this->getBaseUrl();

        // 1. Core pages latest updated_at
        $latestCorePage = Page::whereIn('slug', ['', '/', 'home', 'about-us', 'contact-us', 'privacy-policy', 'terms-and-conditions', 'disclaimer'])
            ->orderBy('updated_at', 'desc')
            ->first();
        $coreLastmod = $this->formatDate($latestCorePage?->updated_at ?? now());

        // 2. Projects latest updated_at
        $latestProject = Project::where('is_active', true)
            ->where(function ($q) { $q->whereNull('status')->orWhere('status', '!=', 'draft'); })
            ->orderBy('updated_at', 'desc')
            ->first();
        $projLastmod = $this->formatDate($latestProject?->updated_at ?? now());

        // 3. Cities latest updated_at
        $latestCity = City::where('is_active', true)
            ->where(function ($q) { $q->whereNull('status')->orWhere('status', '!=', 'draft'); })
            ->orderBy('updated_at', 'desc')
            ->first();
        $cityLastmod = $this->formatDate($latestCity?->updated_at ?? now());

        // 4. Communities / Areas latest updated_at
        $latestCommunity = Community::where('is_active', true)
            ->where(function ($q) { $q->whereNull('status')->orWhere('status', '!=', 'draft'); })
            ->orderBy('updated_at', 'desc')
            ->first();
        $areaLastmod = $this->formatDate($latestCommunity?->updated_at ?? now());

        // 5. Blogs latest updated_at
        $latestBlog = Blog::where('is_published', true)
            ->where(function ($q) { $q->whereNull('status')->orWhere('status', '!=', 'draft'); })
            ->orderBy('updated_at', 'desc')
            ->first();
        $blogLastmod = $this->formatDate($latestBlog?->updated_at ?? now());

        // 6. Dynamic pages latest updated_at
        $excludedSlugs = array_merge(
            ['', '/', 'home', 'about-us', 'contact-us', 'privacy-policy', 'terms-and-conditions', 'disclaimer'],
            Page::projectSlugs(),
            City::pluck('slug')->all(),
            Community::pluck('slug')->all()
        );
        $excludedPageIds = array_merge(
            Project::whereNotNull('page_id')->pluck('page_id')->all(),
            City::whereNotNull('page_id')->pluck('page_id')->all(),
            Community::whereNotNull('page_id')->pluck('page_id')->all()
        );
        $latestDynamicPage = Page::where('is_published', true)
            ->where(function ($q) { $q->whereNull('status')->orWhere('status', '!=', 'draft'); })
            ->whereNotIn('slug', $excludedSlugs)
            ->whereNotIn('id', $excludedPageIds)
            ->orderBy('updated_at', 'desc')
            ->first();
        $dynamicLastmod = $this->formatDate($latestDynamicPage?->updated_at ?? now());

        $sitemaps = [
            ['url' => $baseUrl . '/sitemap/page-sitemap.xml',    'lastmod' => $coreLastmod],
            ['url' => $baseUrl . '/sitemap/project-sitemap.xml', 'lastmod' => $projLastmod],
            ['url' => $baseUrl . '/sitemap/city-sitemap.xml',    'lastmod' => $cityLastmod],
            ['url' => $baseUrl . '/sitemap/area-sitemap.xml',    'lastmod' => $areaLastmod],
            ['url' => $baseUrl . '/sitemap/blog-sitemap.xml',    'lastmod' => $blogLastmod],
            ['url' => $baseUrl . '/sitemap/dynamic-sitemap.xml', 'lastmod' => $dynamicLastmod],
        ];

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        foreach ($sitemaps as $sm) {
            $xml .= "    <url>\n";
            $xml .= "        <loc>{$sm['url']}</loc>\n";
            $xml .= "        <lastmod>{$sm['lastmod']}</lastmod>\n";
            $xml .= "    </url>\n";
        }
        $xml .= '</urlset>';

        return response($xml, 200, [
            'Content-Type'  => 'application/xml; charset=utf-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }

    /**
     * Secondary /sitemap/page-sitemap.xml:
     * Outputs strictly the 6 core pages:
     * Home (priority 1.0) and Contact, About, Privacy Policy, Disclaimer, Terms (priority 0.5).
     */
    public function pageSitemap(): Response
    {
        $baseUrl = $this->getBaseUrl();

        // Query pages for exact timestamps
        $pagesBySlug = Page::whereIn('slug', ['', '/', 'home', 'about-us', 'contact-us', 'privacy-policy', 'terms-and-conditions', 'disclaimer'])
            ->get()
            ->keyBy(fn($p) => trim($p->slug, '/'));

        $items = [
            [
                'path'       => '',
                'slug_key'   => '',
                'changefreq' => 'daily',
                'priority'   => '1.0',
            ],
            [
                'path'       => 'contact-us',
                'slug_key'   => 'contact-us',
                'changefreq' => 'monthly',
                'priority'   => '0.5',
            ],
            [
                'path'       => 'about-us',
                'slug_key'   => 'about-us',
                'changefreq' => 'monthly',
                'priority'   => '0.5',
            ],
            [
                'path'       => 'privacy-policy',
                'slug_key'   => 'privacy-policy',
                'changefreq' => 'yearly',
                'priority'   => '0.5',
            ],
            [
                'path'       => 'disclaimer',
                'slug_key'   => 'disclaimer',
                'changefreq' => 'yearly',
                'priority'   => '0.5',
            ],
            [
                'path'       => 'terms-and-conditions',
                'slug_key'   => 'terms-and-conditions',
                'changefreq' => 'yearly',
                'priority'   => '0.5',
            ],
        ];

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($items as $item) {
            $loc = $item['path'] === '' ? $baseUrl . '/' : $baseUrl . '/' . $item['path'];
            $pageRecord = $pagesBySlug->get($item['slug_key']) ?: ($item['slug_key'] === '' ? $pagesBySlug->get('home') : null);
            $lastmod = $this->formatDate($pageRecord?->updated_at ?? now());

            $xml .= "    <url>\n";
            $xml .= "        <loc>{$loc}</loc>\n";
            $xml .= "        <lastmod>{$lastmod}</lastmod>\n";
            $xml .= "        <changefreq>{$item['changefreq']}</changefreq>\n";
            $xml .= "        <priority>{$item['priority']}</priority>\n";
            $xml .= "    </url>\n";
        }

        $xml .= '</urlset>';

        return response($xml, 200, [
            'Content-Type'  => 'application/xml; charset=utf-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }

    /**
     * /sitemap/project-sitemap.xml:
     * Outputs all active/published project detail pages (/project/{slug}) with priority 0.8.
     */
    public function projectSitemap(): Response
    {
        $baseUrl = $this->getBaseUrl();

        $projects = Project::where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('status')->orWhere('status', '!=', 'draft');
            })
            ->orderBy('order', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($projects as $project) {
            $cleanSlug = ltrim(preg_replace('#^project/#', '', trim($project->slug, '/')), '/');
            if ($cleanSlug === '') continue;

            $loc = $baseUrl . '/project/' . $cleanSlug;
            $lastmod = $this->formatDate($project->updated_at ?? now());

            $xml .= "    <url>\n";
            $xml .= "        <loc>{$loc}</loc>\n";
            $xml .= "        <lastmod>{$lastmod}</lastmod>\n";
            $xml .= "        <changefreq>weekly</changefreq>\n";
            $xml .= "        <priority>0.8</priority>\n";
            $xml .= "    </url>\n";
        }

        $xml .= '</urlset>';

        return response($xml, 200, [
            'Content-Type'  => 'application/xml; charset=utf-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }

    /**
     * /sitemap/city-sitemap.xml:
     * Outputs all active/published city pages (/city/{slug}) with priority 0.8.
     */
    public function citySitemap(): Response
    {
        $baseUrl = $this->getBaseUrl();

        $cities = City::with('page')
            ->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('status')->orWhere('status', '!=', 'draft');
            })
            ->orderBy('order', 'asc')
            ->get();

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($cities as $city) {
            $cleanSlug = ltrim(preg_replace('#^city/#', '', trim($city->slug, '/')), '/');
            if ($cleanSlug === '') continue;

            $loc = $baseUrl . '/city/' . $cleanSlug;
            $lastmod = $this->formatDate($city->page?->updated_at ?? $city->updated_at ?? now());

            $xml .= "    <url>\n";
            $xml .= "        <loc>{$loc}</loc>\n";
            $xml .= "        <lastmod>{$lastmod}</lastmod>\n";
            $xml .= "        <changefreq>weekly</changefreq>\n";
            $xml .= "        <priority>0.8</priority>\n";
            $xml .= "    </url>\n";
        }

        $xml .= '</urlset>';

        return response($xml, 200, [
            'Content-Type'  => 'application/xml; charset=utf-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }

    /**
     * /sitemap/area-sitemap.xml:
     * Outputs all active/published community & neighbourhood pages (/area/{slug}) with priority 0.8.
     */
    public function areaSitemap(): Response
    {
        $baseUrl = $this->getBaseUrl();

        $communities = Community::with('page')
            ->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('status')->orWhere('status', '!=', 'draft');
            })
            ->orderBy('order', 'asc')
            ->get();

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($communities as $community) {
            $cleanSlug = ltrim(preg_replace('#^area/#', '', trim($community->slug, '/')), '/');
            if ($cleanSlug === '') continue;

            $loc = $baseUrl . '/area/' . $cleanSlug;
            $lastmod = $this->formatDate($community->page?->updated_at ?? $community->updated_at ?? now());

            $xml .= "    <url>\n";
            $xml .= "        <loc>{$loc}</loc>\n";
            $xml .= "        <lastmod>{$lastmod}</lastmod>\n";
            $xml .= "        <changefreq>weekly</changefreq>\n";
            $xml .= "        <priority>0.8</priority>\n";
            $xml .= "    </url>\n";
        }

        $xml .= '</urlset>';

        return response($xml, 200, [
            'Content-Type'  => 'application/xml; charset=utf-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }

    /**
     * /sitemap/blog-sitemap.xml:
     * Outputs all published blog posts (/blog/{slug}) with priority 0.8.
     */
    public function blogSitemap(): Response
    {
        $baseUrl = $this->getBaseUrl();

        $blogs = Blog::where('is_published', true)
            ->where(function ($q) {
                $q->whereNull('status')->orWhere('status', '!=', 'draft');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        // Blog listing root
        $xml .= "    <url>\n";
        $xml .= "        <loc>{$baseUrl}/blogs</loc>\n";
        $xml .= "        <lastmod>" . $this->formatDate($blogs->first()?->updated_at ?? now()) . "</lastmod>\n";
        $xml .= "        <changefreq>daily</changefreq>\n";
        $xml .= "        <priority>0.8</priority>\n";
        $xml .= "    </url>\n";

        foreach ($blogs as $blog) {
            $cleanSlug = ltrim(preg_replace('#^blog/#', '', trim($blog->slug, '/')), '/');
            if ($cleanSlug === '') continue;

            $loc = $baseUrl . '/blog/' . $cleanSlug;
            $lastmod = $this->formatDate($blog->updated_at ?? now());

            $xml .= "    <url>\n";
            $xml .= "        <loc>{$loc}</loc>\n";
            $xml .= "        <lastmod>{$lastmod}</lastmod>\n";
            $xml .= "        <changefreq>weekly</changefreq>\n";
            $xml .= "        <priority>0.8</priority>\n";
            $xml .= "    </url>\n";
        }

        $xml .= '</urlset>';

        return response($xml, 200, [
            'Content-Type'  => 'application/xml; charset=utf-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }

    /**
     * /sitemap/dynamic-sitemap.xml:
     * Outputs all custom dynamic pages created via "+ Add Page" in Manage Pages CMS (Image 2)
     * strictly excluding the 6 core pages, projects, cities, and communities.
     * All items rendered with priority 0.8.
     */
    public function dynamicSitemap(): Response
    {
        $baseUrl = $this->getBaseUrl();

        $coreSlugs = ['', '/', 'home', 'about-us', 'contact-us', 'privacy-policy', 'terms-and-conditions', 'disclaimer'];
        $projectSlugs = Page::projectSlugs();
        $citySlugs = City::pluck('slug')->all();
        $commSlugs = Community::pluck('slug')->all();

        $excludedSlugs = array_merge($coreSlugs, $projectSlugs, $citySlugs, $commSlugs);

        $excludedPageIds = array_merge(
            Project::whereNotNull('page_id')->pluck('page_id')->all(),
            City::whereNotNull('page_id')->pluck('page_id')->all(),
            Community::whereNotNull('page_id')->pluck('page_id')->all()
        );

        $dynamicPages = Page::where('is_published', true)
            ->where(function ($q) {
                $q->whereNull('status')->orWhere('status', '!=', 'draft');
            })
            ->whereNotIn('slug', $excludedSlugs)
            ->whereNotIn('id', $excludedPageIds)
            ->orderBy('id', 'asc')
            ->get();

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($dynamicPages as $page) {
            $cleanSlug = ltrim(trim($page->slug, '/'), '/');
            if ($cleanSlug === '') continue;

            $loc = $baseUrl . '/' . $cleanSlug;
            $lastmod = $this->formatDate($page->updated_at ?? now());

            $xml .= "    <url>\n";
            $xml .= "        <loc>{$loc}</loc>\n";
            $xml .= "        <lastmod>{$lastmod}</lastmod>\n";
            $xml .= "        <changefreq>weekly</changefreq>\n";
            $xml .= "        <priority>0.8</priority>\n";
            $xml .= "    </url>\n";
        }

        $xml .= '</urlset>';

        return response($xml, 200, [
            'Content-Type'  => 'application/xml; charset=utf-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }
}
