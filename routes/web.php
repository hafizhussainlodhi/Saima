<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ContentController as AdminContentController;
use App\Http\Controllers\Admin\TocController as AdminTocController;
use App\Http\Controllers\Admin\LeadController as AdminLeadController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\CityController as AdminCityController;
use App\Http\Controllers\Admin\CommunityController as AdminCommunityController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\AmenityController as AdminAmenityController;
use App\Http\Controllers\SitemapController;

Route::get('/', function () {
    return view('home');
})->name('home');

// Dynamic XML Sitemap
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap.xml');
Route::get('/sitemap', fn () => redirect('/sitemap.xml', 301));

Route::get('/sitemap/page-sitemap.xml', [SitemapController::class, 'pageSitemap'])->name('sitemap.page');
Route::get('/page-sitemap.xml', [SitemapController::class, 'pageSitemap']);
Route::get('/sitemap/page-sitemap', fn () => redirect('/sitemap/page-sitemap.xml', 301));

Route::get('/sitemap/project-sitemap.xml', [SitemapController::class, 'projectSitemap'])->name('sitemap.project');
Route::get('/project-sitemap.xml', [SitemapController::class, 'projectSitemap']);
Route::get('/sitemap/project-sitemap', fn () => redirect('/sitemap/project-sitemap.xml', 301));

Route::get('/sitemap/city-sitemap.xml', [SitemapController::class, 'citySitemap'])->name('sitemap.city');
Route::get('/city-sitemap.xml', [SitemapController::class, 'citySitemap']);
Route::get('/sitemap/city-sitemap', fn () => redirect('/sitemap/city-sitemap.xml', 301));

Route::get('/sitemap/area-sitemap.xml', [SitemapController::class, 'areaSitemap'])->name('sitemap.area');
Route::get('/area-sitemap.xml', [SitemapController::class, 'areaSitemap']);
Route::get('/sitemap/area-sitemap', fn () => redirect('/sitemap/area-sitemap.xml', 301));

Route::get('/sitemap/blog-sitemap.xml', [SitemapController::class, 'blogSitemap'])->name('sitemap.blog');
Route::get('/blog-sitemap.xml', [SitemapController::class, 'blogSitemap']);
Route::get('/sitemap/blog-sitemap', fn () => redirect('/sitemap/blog-sitemap.xml', 301));

Route::get('/sitemap/dynamic-sitemap.xml', [SitemapController::class, 'dynamicSitemap'])->name('sitemap.dynamic');
Route::get('/dynamic-sitemap.xml', [SitemapController::class, 'dynamicSitemap']);
Route::get('/sitemap/dynamic-sitemap', fn () => redirect('/sitemap/dynamic-sitemap.xml', 301));

// API & Form Leads Endpoints
Route::post('/api/leads', [LeadController::class, 'store'])->name('leads.store');
Route::get('/api/detect-country', [LeadController::class, 'detectCountry'])->name('leads.detect-country');
Route::get('/api/navbar-items', function (\Illuminate\Http\Request $request) {
    $currentSlug = $request->query('current_slug');
    $currentPageId = $request->query('current_page_id');
    return response()->json([
        'projects'   => get_navbar_projects($currentSlug, $currentPageId),
        'commercial' => get_navbar_commercial($currentSlug, $currentPageId),
    ]);
})->name('api.navbar-items');



// Dedicated Contact Us Page (Port 3000 Parity)
Route::get('/contact-us', function () {
    return view('contact-us');
})->name('contact-us');

Route::get('/contact', function () {
    return redirect('/contact-us');
});

// Dedicated About Us Page (Port 3000 Parity)
Route::get('/about-us', function () {
    return view('about-us');
})->name('about-us');

Route::get('/about', function () {
    return redirect('/about-us');
});

// Footer Legal Pages (100% Port 3000 Parity)
Route::get('/privacy-policy', function () {
    return view('privacy-policy');
})->name('privacy-policy');

Route::get('/privacy', function () {
    return redirect('/privacy-policy');
});

Route::get('/terms-and-conditions', function () {
    return view('terms-and-conditions');
})->name('terms-and-conditions');

Route::get('/terms', function () {
    return redirect('/terms-and-conditions');
});

Route::get('/disclaimer', function () {
    return view('disclaimer');
})->name('disclaimer');

/*
|--------------------------------------------------------------------------
| Admin CMS (/admin)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    // Authentication
    Route::get('/', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->middleware('throttle:6,1')->name('login.submit');

    Route::middleware('auth')->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Website text (CMS)
        Route::get('/content', [AdminContentController::class, 'index'])->name('content.index');
        Route::put('/content', [AdminContentController::class, 'update'])->name('content.update');
        Route::post('/content', [AdminContentController::class, 'store'])->name('content.store');
        Route::post('/content/{content}/reset', [AdminContentController::class, 'reset'])->name('content.reset');
        Route::delete('/content/{content}', [AdminContentController::class, 'destroy'])->name('content.destroy');

        // Pages CMS (Page-Wise & Section-Wise Centralized)
        Route::middleware('permission:pages')->group(function () {
            Route::get('/pages', [AdminPageController::class, 'index'])->name('pages.index');
            Route::post('/pages', [AdminPageController::class, 'store'])->name('pages.store');
            Route::get('/pages/{page}/edit', [AdminPageController::class, 'edit'])->name('pages.edit');
            Route::put('/pages/{page}', [AdminPageController::class, 'update'])->name('pages.update');
            Route::delete('/pages/{page}', [AdminPageController::class, 'destroy'])->name('pages.destroy');
            Route::patch('/pages/{page}/toggle-navbar', [AdminPageController::class, 'toggleNavbar'])->name('pages.toggle-navbar');
            Route::patch('/pages/{page}/toggle-published', [AdminPageController::class, 'togglePublished'])->name('pages.toggle-published');
            Route::patch('/pages/{page}/status', [AdminPageController::class, 'updateStatus'])->name('pages.status');
            Route::post('/pages/{page}/reorder-sections', [AdminPageController::class, 'reorderSections'])->name('pages.reorder-sections');

            // Projects CMS (Dedicated Property Cards Manager)
            Route::get('/projects', [AdminProjectController::class, 'index'])->name('projects.index');
            Route::post('/projects', [AdminProjectController::class, 'store'])->name('projects.store');
            Route::get('/projects/{project}/edit', [AdminProjectController::class, 'edit'])->name('projects.edit');
            Route::put('/projects/{project}', [AdminProjectController::class, 'update'])->name('projects.update');
            Route::delete('/projects/{project}', [AdminProjectController::class, 'destroy'])->name('projects.destroy');
            Route::patch('/projects/{project}/toggle', [AdminProjectController::class, 'toggle'])->name('projects.toggle');
            Route::patch('/projects/{project}/status', [AdminProjectController::class, 'updateStatus'])->name('projects.status');
            Route::post('/projects/reorder', [AdminProjectController::class, 'reorder'])->name('projects.reorder');

            // Cities CMS (Dedicated City Pages Manager)
            Route::get('/cities', [AdminCityController::class, 'index'])->name('cities.index');
            Route::post('/cities', [AdminCityController::class, 'store'])->name('cities.store');
            Route::get('/cities/{city}/edit', [AdminCityController::class, 'edit'])->name('cities.edit');
            Route::put('/cities/{city}', [AdminCityController::class, 'update'])->name('cities.update');
            Route::delete('/cities/{city}', [AdminCityController::class, 'destroy'])->name('cities.destroy');
            Route::patch('/cities/{city}/status', [AdminCityController::class, 'updateStatus'])->name('cities.status');

            // Neighbourhood / Community CMS (Dedicated Community Pages Manager)
            Route::get('/communities', [AdminCommunityController::class, 'index'])->name('communities.index');
            Route::post('/communities', [AdminCommunityController::class, 'store'])->name('communities.store');
            Route::get('/communities/{community}/edit', [AdminCommunityController::class, 'edit'])->name('communities.edit');
            Route::put('/communities/{community}', [AdminCommunityController::class, 'update'])->name('communities.update');
            Route::delete('/communities/{community}', [AdminCommunityController::class, 'destroy'])->name('communities.destroy');
            Route::patch('/communities/{community}/status', [AdminCommunityController::class, 'updateStatus'])->name('communities.status');

            // Blog CMS
            Route::get('/blogs', [AdminBlogController::class, 'index'])->name('blogs.index');
            Route::post('/blogs', [AdminBlogController::class, 'store'])->name('blogs.store');
            Route::get('/blogs/{blog}/edit', [AdminBlogController::class, 'edit'])->name('blogs.edit');
            Route::put('/blogs/{blog}', [AdminBlogController::class, 'update'])->name('blogs.update');
            Route::delete('/blogs/{blog}', [AdminBlogController::class, 'destroy'])->name('blogs.destroy');
            Route::patch('/blogs/{blog}/status', [AdminBlogController::class, 'updateStatus'])->name('blogs.status');

            // Amenities CMS
            Route::get('/amenities', [AdminAmenityController::class, 'index'])->name('amenities.index');
            Route::post('/amenities', [AdminAmenityController::class, 'store'])->name('amenities.store');
            Route::put('/amenities/{amenity}', [AdminAmenityController::class, 'update'])->name('amenities.update');
            Route::delete('/amenities/{amenity}', [AdminAmenityController::class, 'destroy'])->name('amenities.destroy');
            Route::get('/api/amenities', [AdminAmenityController::class, 'listJson'])->name('amenities.json');
        });

        // Table of Contents
        Route::middleware('permission:toc')->group(function () {
            Route::get('/toc', [AdminTocController::class, 'index'])->name('toc.index');
            Route::post('/toc/reorder', [AdminTocController::class, 'reorder'])->name('toc.reorder');
            Route::post('/toc', [AdminTocController::class, 'store'])->name('toc.store');
            Route::put('/toc/{toc}', [AdminTocController::class, 'update'])->name('toc.update');
            Route::delete('/toc/{toc}', [AdminTocController::class, 'destroy'])->name('toc.destroy');
            Route::patch('/toc/{toc}/toggle', [AdminTocController::class, 'toggle'])->name('toc.toggle');
            Route::patch('/toc/{toc}/move', [AdminTocController::class, 'move'])->name('toc.move');
        });

        // Leads
        Route::middleware('permission:leads')->group(function () {
            Route::get('/leads', [AdminLeadController::class, 'index'])->name('leads.index');
            Route::get('/leads/export', [AdminLeadController::class, 'export'])->name('leads.export');
            Route::get('/leads/{lead}', [AdminLeadController::class, 'show'])->name('leads.show');
            Route::patch('/leads/{lead}/status', [AdminLeadController::class, 'updateStatus'])->name('leads.status');
            Route::delete('/leads/{lead}', [AdminLeadController::class, 'destroy'])->name('leads.destroy');
        });

        // Site Settings: Global SEO & Indexing
        Route::middleware('permission:seo')->group(function () {
            Route::get('/seo', [\App\Http\Controllers\Admin\SeoController::class, 'index'])->name('seo.index');
            Route::put('/seo', [\App\Http\Controllers\Admin\SeoController::class, 'update'])->name('seo.update');
        });

        // Site Settings: Footer & Newsletter (matching Image 2 & Image 3)
        Route::middleware('permission:footer')->group(function () {
            Route::get('/footer', [\App\Http\Controllers\Admin\FooterController::class, 'index'])->name('footer.index');
            Route::put('/footer', [\App\Http\Controllers\Admin\FooterController::class, 'update'])->name('footer.update');
            // Support alias /footer-sections/1/edit if navigated directly like Image 2
            Route::get('/footer-sections/1/edit', fn () => redirect()->route('admin.footer.index'));
        });

        // Site Settings: Users & Permissions (Granular Access Control)
        Route::middleware('permission:users')->group(function () {
            Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
        });
    });
});

// Public Blog Routes
Route::get('/blogs', function () {
    $blogs = \App\Models\Blog::where('is_published', true)
        ->where('status', 'publish')
        ->orderBy('created_at', 'desc')
        ->paginate(12);
    return view('blogs.index', compact('blogs'));
})->name('blogs.public.index');

Route::get('/blog', fn() => redirect()->route('blogs.public.index'));

Route::get('/blog/{slug}', function ($slug) {
    $cleanSlug = trim(urldecode($slug), '/');
    $slugVariants = [
        $cleanSlug,
        '/' . $cleanSlug,
        \Illuminate\Support\Str::slug($cleanSlug),
        ltrim(\Illuminate\Support\Str::slug($cleanSlug), '/'),
    ];
    $blog = \App\Models\Blog::whereIn('slug', $slugVariants)->first();
    if (!$blog || !$blog->is_published || $blog->status === 'draft') {
        abort(404);
    }
    return view('blogs.show', compact('blog'));
})->where('slug', '^[a-zA-Z0-9_\-\/% ]+$')->name('blogs.public.show');

// Dedicated Public Property / Project Routes (/project/{slug})
Route::get('/project', fn() => redirect('/#communities'));

Route::get('/project/{slug}', function ($slug) {
    $cleanSlug = ltrim(urldecode($slug), '/');

    // Redirect underscore variants (e.g. /project/wadeem_gardens -> /project/wadeem-gardens)
    if (str_contains($cleanSlug, '_')) {
        return redirect('/project/' . str_replace('_', '-', $cleanSlug), 301);
    }

    $page = \App\Models\Page::where('slug', $cleanSlug)
        ->orWhere('slug', '/' . $cleanSlug)
        ->orWhere('slug', 'project/' . $cleanSlug)
        ->orWhere('slug', '/project/' . $cleanSlug)
        ->first();

    if ($page) {
        // If status is draft or page is unpublished, block public UI view (404)
        if (!$page->is_published || $page->status === 'draft') {
            abort(404);
        }

        // Check if page belongs to a Project and that Project is in draft or inactive
        $project = \App\Models\Project::where('page_id', $page->id)
            ->orWhere('slug', $cleanSlug)
            ->orWhere('slug', '/' . $cleanSlug)
            ->first();
        if ($project && (!$project->is_active || $project->status === 'draft')) {
            abort(404);
        }

        // Check if a dedicated custom community blade file exists
        if (view()->exists('communities.' . $cleanSlug)) {
            return view('communities.' . $cleanSlug, compact('page', 'project'));
        }
        if (view()->exists($cleanSlug)) {
            return view($cleanSlug, compact('page', 'project'));
        }

        return view('dynamic-page', compact('page', 'project'));
    }

    // Check if slug matches a standalone Project (even if Page record is missing)
    $project = \App\Models\Project::where('slug', $cleanSlug)->orWhere('slug', '/' . $cleanSlug)->first();
    if ($project) {
        if (!$project->is_active || $project->status === 'draft') {
            abort(404);
        }
        if (view()->exists('communities.' . $cleanSlug)) {
            return view('communities.' . $cleanSlug, compact('project'));
        }
        if (view()->exists($cleanSlug)) {
            return view($cleanSlug, compact('project'));
        }
        return view('dynamic-page', compact('project'));
    }

    // Check if cleanSlug is one of the static community templates
    if (in_array($cleanSlug, \App\Models\Page::projectSlugs(), true)) {
        if (view()->exists('communities.' . $cleanSlug)) {
            return view('communities.' . $cleanSlug);
        }
    }

    abort(404);
})->where('slug', '^[a-zA-Z0-9_\-\/% ]+$')->name('projects.public.show');

// Dedicated Public City Routes (/city/{slug})
Route::get('/city', fn() => redirect('/'));

Route::get('/city/{slug}', function ($slug) {
    $cleanSlug = ltrim(urldecode($slug), '/');

    // Redirect underscore variants (e.g. /city/lahore_city -> /city/lahore-city)
    if (str_contains($cleanSlug, '_')) {
        return redirect('/city/' . str_replace('_', '-', $cleanSlug), 301);
    }

    $city = \App\Models\City::where('slug', $cleanSlug)
        ->orWhere('slug', '/' . $cleanSlug)
        ->orWhere('slug', 'city/' . $cleanSlug)
        ->orWhere('slug', '/city/' . $cleanSlug)
        ->first();

    if ($city) {
        if (!$city->is_active || $city->status === 'draft') {
            abort(404);
        }

        $page = $city->page ?: \App\Models\Page::where('slug', $cleanSlug)
            ->orWhere('slug', '/' . $cleanSlug)
            ->orWhere('slug', 'city/' . $cleanSlug)
            ->orWhere('slug', '/city/' . $cleanSlug)
            ->first();

        if ($page) {
            if (!$page->is_published || $page->status === 'draft') {
                abort(404);
            }
            if (view()->exists('communities.' . $cleanSlug)) {
                return view('communities.' . $cleanSlug, compact('page', 'city'));
            }
            if (view()->exists($cleanSlug)) {
                return view($cleanSlug, compact('page', 'city'));
            }
            return view('dynamic-page', compact('page', 'city'));
        }

        return view('dynamic-page', compact('city'));
    }

    // Check if Page belongs to City
    $page = \App\Models\Page::where('slug', $cleanSlug)
        ->orWhere('slug', '/' . $cleanSlug)
        ->orWhere('slug', 'city/' . $cleanSlug)
        ->orWhere('slug', '/city/' . $cleanSlug)
        ->first();

    if ($page) {
        $city = \App\Models\City::where('page_id', $page->id)->first();
        if ($city) {
            if (!$city->is_active || $city->status === 'draft' || !$page->is_published || $page->status === 'draft') {
                abort(404);
            }
            return view('dynamic-page', compact('page', 'city'));
        }
    }

    abort(404);
})->where('slug', '^[a-zA-Z0-9_\-\/% ]+$')->name('cities.public.show');

// Dedicated Public Community / Area Routes (/area/{slug})
Route::get('/area', fn() => redirect('/#communities'));

Route::get('/area/{slug}', function ($slug) {
    $cleanSlug = ltrim(urldecode($slug), '/');

    // Redirect underscore variants (e.g. /area/jamshed_road -> /area/jamshed-road)
    if (str_contains($cleanSlug, '_')) {
        return redirect('/area/' . str_replace('_', '-', $cleanSlug), 301);
    }

    $community = \App\Models\Community::where('slug', $cleanSlug)
        ->orWhere('slug', '/' . $cleanSlug)
        ->orWhere('slug', 'area/' . $cleanSlug)
        ->orWhere('slug', '/area/' . $cleanSlug)
        ->first();

    if ($community) {
        if (!$community->is_active || $community->status === 'draft') {
            abort(404);
        }

        $page = $community->page ?: \App\Models\Page::where('slug', $cleanSlug)
            ->orWhere('slug', '/' . $cleanSlug)
            ->orWhere('slug', 'area/' . $cleanSlug)
            ->orWhere('slug', '/area/' . $cleanSlug)
            ->first();

        if ($page) {
            if (!$page->is_published || $page->status === 'draft') {
                abort(404);
            }
            if (view()->exists('communities.' . $cleanSlug)) {
                return view('communities.' . $cleanSlug, compact('page', 'community'));
            }
            if (view()->exists($cleanSlug)) {
                return view($cleanSlug, compact('page', 'community'));
            }
            return view('dynamic-page', compact('page', 'community'));
        }

        return view('dynamic-page', compact('community'));
    }

    // Check if Page belongs to Community
    $page = \App\Models\Page::where('slug', $cleanSlug)
        ->orWhere('slug', '/' . $cleanSlug)
        ->orWhere('slug', 'area/' . $cleanSlug)
        ->orWhere('slug', '/area/' . $cleanSlug)
        ->first();

    if ($page) {
        $community = \App\Models\Community::where('page_id', $page->id)->first();
        if ($community) {
            if (!$community->is_active || $community->status === 'draft' || !$page->is_published || $page->status === 'draft') {
                abort(404);
            }
            return view('dynamic-page', compact('page', 'community'));
        }
    }

    abort(404);
})->where('slug', '^[a-zA-Z0-9_\-\/% ]+$')->name('communities.public.show');

// Dynamic Public Page Catch-All Route for created pages & blogs
Route::get('/{slug}', function ($slug) {
    $cleanSlug = ltrim(urldecode($slug), '/');

    // Never intercept reserved routes
    if (in_array($cleanSlug, ['admin', 'project', 'city', 'area', 'blogs', 'blog'], true)
        || str_starts_with($cleanSlug, 'admin/')
        || str_starts_with($cleanSlug, 'project/')
        || str_starts_with($cleanSlug, 'city/')
        || str_starts_with($cleanSlug, 'area/')
        || str_starts_with($cleanSlug, 'blog/')) {
        abort(404);
    }

    // Redirect underscore variants (e.g. /wadeem_gardens -> /project/wadeem-gardens or /area/slug or /city/slug)
    if (str_contains($cleanSlug, '_')) {
        $hyphenSlug = str_replace('_', '-', $cleanSlug);
        $isProj = in_array($hyphenSlug, \App\Models\Page::projectSlugs(), true)
            || \App\Models\Project::where('slug', $hyphenSlug)->orWhere('slug', '/' . $hyphenSlug)->exists();
        if ($isProj) return redirect('/project/' . $hyphenSlug, 301);

        $isCity = \App\Models\City::where('slug', $hyphenSlug)->orWhere('slug', '/' . $hyphenSlug)->exists();
        if ($isCity) return redirect('/city/' . $hyphenSlug, 301);

        $isComm = \App\Models\Community::where('slug', $hyphenSlug)->orWhere('slug', '/' . $hyphenSlug)->exists();
        if ($isComm) return redirect('/area/' . $hyphenSlug, 301);

        return redirect('/' . $hyphenSlug, 301);
    }

    // If it's a project/property page, 301 redirect to /project/{slug}
    $isProjectSlug = in_array($cleanSlug, \App\Models\Page::projectSlugs(), true)
        || \App\Models\Project::where('slug', $cleanSlug)->orWhere('slug', '/' . $cleanSlug)->exists()
        || \App\Models\Project::whereHas('page', fn($q) => $q->where('slug', $cleanSlug)->orWhere('slug', '/' . $cleanSlug))->exists();

    if ($isProjectSlug) {
        return redirect('/project/' . $cleanSlug, 301);
    }

    // If it's a city page, 301 redirect to /city/{slug}
    $isCitySlug = \App\Models\City::where('slug', $cleanSlug)->orWhere('slug', '/' . $cleanSlug)->exists()
        || \App\Models\City::whereHas('page', fn($q) => $q->where('slug', $cleanSlug)->orWhere('slug', '/' . $cleanSlug))->exists();

    if ($isCitySlug) {
        return redirect('/city/' . $cleanSlug, 301);
    }

    // If it's a community/area page, 301 redirect to /area/{slug}
    $isCommunitySlug = \App\Models\Community::where('slug', $cleanSlug)->orWhere('slug', '/' . $cleanSlug)->exists()
        || \App\Models\Community::whereHas('page', fn($q) => $q->where('slug', $cleanSlug)->orWhere('slug', '/' . $cleanSlug))->exists();

    if ($isCommunitySlug) {
        return redirect('/area/' . $cleanSlug, 301);
    }

    $page = \App\Models\Page::where('slug', $cleanSlug)
        ->orWhere('slug', '/' . $cleanSlug)
        ->first();

    if ($page) {
        // If status is draft or page is unpublished, block public UI view (404)
        if (!$page->is_published || $page->status === 'draft') {
            abort(404);
        }

        // Check if page belongs to a Community and that Community is in draft or inactive
        $community = \App\Models\Community::where('page_id', $page->id)
            ->orWhere('slug', $cleanSlug)
            ->orWhere('slug', '/' . $cleanSlug)
            ->first();
        if ($community && (!$community->is_active || $community->status === 'draft')) {
            abort(404);
        }

        // Check if page belongs to a City and that City is in draft or inactive
        $city = \App\Models\City::where('slug', $cleanSlug)
            ->orWhere('slug', '/' . $cleanSlug)
            ->first();
        if ($city && (!$city->is_active || $city->status === 'draft')) {
            abort(404);
        }

        // Check if page belongs to a Project and that Project is in draft or inactive
        $project = \App\Models\Project::where('slug', $cleanSlug)
            ->orWhere('slug', '/' . $cleanSlug)
            ->first();
        if ($project && (!$project->is_active || $project->status === 'draft')) {
            abort(404);
        }

        // Check if a dedicated custom community blade file exists
        if (view()->exists('communities.' . $cleanSlug)) {
            return view('communities.' . $cleanSlug, compact('page'));
        }
        if (view()->exists($cleanSlug)) {
            return view($cleanSlug, compact('page'));
        }

        // Otherwise render universal dynamic community page
        return view('dynamic-page', compact('page'));
    }

    // Check if slug matches a standalone Project, Community, or City (even if Page record is missing)
    $project = \App\Models\Project::where('slug', $cleanSlug)->orWhere('slug', '/' . $cleanSlug)->first();
    if ($project) {
        if (!$project->is_active || $project->status === 'draft') {
            abort(404);
        }
        if (view()->exists('communities.' . $cleanSlug)) {
            return view('communities.' . $cleanSlug);
        }
        if (view()->exists($cleanSlug)) {
            return view($cleanSlug);
        }
    }

    $community = \App\Models\Community::where('slug', $cleanSlug)->orWhere('slug', '/' . $cleanSlug)->first();
    if ($community) {
        if (!$community->is_active || $community->status === 'draft') {
            abort(404);
        }
        if (view()->exists('communities.' . $cleanSlug)) {
            return view('communities.' . $cleanSlug);
        }
    }

    $city = \App\Models\City::where('slug', $cleanSlug)->orWhere('slug', '/' . $cleanSlug)->first();
    if ($city) {
        if (!$city->is_active || $city->status === 'draft') {
            abort(404);
        }
    }

    // Check if it matches a Blog post - 301 redirect to /blog/{slug}
    $slugVariants = [
        $cleanSlug,
        '/' . $cleanSlug,
        \Illuminate\Support\Str::slug($cleanSlug),
        ltrim(\Illuminate\Support\Str::slug($cleanSlug), '/'),
    ];
    $blog = \App\Models\Blog::whereIn('slug', $slugVariants)->first();
    if ($blog) {
        if (!$blog->is_published || $blog->status === 'draft') {
            abort(404);
        }
        return redirect('/blog/' . $blog->slug, 301);
    }

    abort(404);
})->where('slug', '^(?!admin(\/|$))[a-zA-Z0-9_\-\/% ]+$')->name('pages.dynamic');


