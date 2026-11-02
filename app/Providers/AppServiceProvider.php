<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (file_exists(app_path('helpers.php'))) {
            require_once app_path('helpers.php');
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer(['admin.*'], function ($view) {
            try {
                if (\Illuminate\Support\Facades\Schema::hasTable('amenities')) {
                    $view->with('allAmenities', \App\Models\Amenity::where('is_active', true)->orderBy('order', 'asc')->orderBy('name', 'asc')->get());
                } else {
                    $view->with('allAmenities', collect());
                }
                if (\Illuminate\Support\Facades\Schema::hasTable('communities')) {
                    $view->with('communities', \App\Models\Community::with('city')->orderBy('order', 'asc')->orderBy('name', 'asc')->get());
                } else {
                    $view->with('communities', collect());
                }
            } catch (\Throwable $e) {
                $view->with('allAmenities', collect());
                $view->with('communities', collect());
            }
        });

        view()->composer(['partials.header', 'layouts.app'], function ($view) {
            try {
                $viewData = $view->getData();
                $pageSlug = $viewData['page']->slug ?? null;
                $pageId = $viewData['page']->id ?? null;
                $view->with('navbarProjects', get_navbar_projects($pageSlug, $pageId));
                $view->with('navbarCommercial', get_navbar_commercial($pageSlug, $pageId));
            } catch (\Throwable $e) {
                $view->with('navbarProjects', collect());
                $view->with('navbarCommercial', collect());
            }
        });
    }
}
