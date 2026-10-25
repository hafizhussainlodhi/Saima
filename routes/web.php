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

Route::get('/', function () {
    return view('home');
})->name('home');

// API & Form Leads Endpoints
Route::post('/api/leads', [LeadController::class, 'store'])->name('leads.store');
Route::get('/api/detect-country', [LeadController::class, 'detectCountry'])->name('leads.detect-country');

// Dedicated Community Property Pages (100% Port 3000 Parity)
Route::get('/wadeem-gardens', function () { return view('communities.wadeem-gardens'); })->name('wadeem-gardens');
Route::get('/hudayriyat-golf-estates', function () { return view('communities.hudayriyat-golf-estates'); })->name('hudayriyat-golf-estates');
Route::get('/bashayer-villas', function () { return view('communities.bashayer-villas'); })->name('bashayer-villas');
Route::get('/bashayer-residences', function () { return view('communities.bashayer-residences'); })->name('bashayer-residences');
Route::get('/al-naseem-villas', function () { return view('communities.al-naseem-villas'); })->name('al-naseem-villas');
Route::get('/nawayef-east-hills', function () { return view('communities.nawayef-east-hills'); })->name('nawayef-east-hills');
Route::get('/masyaf-plots', function () { return view('communities.masyaf-plots'); })->name('masyaf-plots');
Route::get('/nawayef-village', function () { return view('communities.nawayef-village'); })->name('nawayef-village');
Route::get('/wadeem-plots', function () { return view('communities.wadeem-plots'); })->name('wadeem-plots');
Route::get('/nawayef-park-views', function () { return view('communities.nawayef-park-views'); })->name('nawayef-park-views');

// Support underscore variants (e.g. /wadeem_gardens -> /wadeem-gardens)
Route::get('/wadeem_gardens', function () { return redirect('/wadeem-gardens'); });
Route::get('/hudayriyat_golf_estates', function () { return redirect('/hudayriyat-golf-estates'); });
Route::get('/bashayer_villas', function () { return redirect('/bashayer-villas'); });
Route::get('/bashayer_residences', function () { return redirect('/bashayer-residences'); });
Route::get('/al_naseem_villas', function () { return redirect('/al-naseem-villas'); });
Route::get('/nawayef_east_hills', function () { return redirect('/nawayef-east-hills'); });
Route::get('/masyaf_plots', function () { return redirect('/masyaf-plots'); });
Route::get('/nawayef_village', function () { return redirect('/nawayef-village'); });
Route::get('/wadeem_plots', function () { return redirect('/wadeem-plots'); });
Route::get('/nawayef_park_views', function () { return redirect('/nawayef-park-views'); });
Route::get('/contact_us', function () { return redirect('/contact-us'); });
Route::get('/about_us', function () { return redirect('/about-us'); });

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
            Route::post('/pages/{page}/reorder-sections', [AdminPageController::class, 'reorderSections'])->name('pages.reorder-sections');

            // Projects CMS (Dedicated Property Cards Manager)
            Route::get('/projects', [AdminProjectController::class, 'index'])->name('projects.index');
            Route::post('/projects', [AdminProjectController::class, 'store'])->name('projects.store');
            Route::put('/projects/{project}', [AdminProjectController::class, 'update'])->name('projects.update');
            Route::delete('/projects/{project}', [AdminProjectController::class, 'destroy'])->name('projects.destroy');
            Route::patch('/projects/{project}/toggle', [AdminProjectController::class, 'toggle'])->name('projects.toggle');
            Route::post('/projects/reorder', [AdminProjectController::class, 'reorder'])->name('projects.reorder');
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

// Dynamic Public Page Catch-All Route for created pages
Route::get('/{slug}', function ($slug) {
    $cleanSlug = ltrim($slug, '/');
    $page = \App\Models\Page::where('slug', $cleanSlug)
        ->orWhere('slug', '/' . $cleanSlug)
        ->first();

    if (!$page) {
        abort(404);
    }

    if (!$page->is_published && !auth()->check()) {
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
})->where('slug', '^[a-zA-Z0-9_\-\/]+$')->name('pages.dynamic');

