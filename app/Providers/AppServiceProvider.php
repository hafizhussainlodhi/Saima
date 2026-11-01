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
                if (\Illuminate\Support\Facades\Schema::hasTable('projects')) {
                    $navbarProjects = \App\Models\Project::with('page')
                        ->where(function ($q) {
                            $q->where('status', 'publish')
                              ->orWhere(function ($q2) {
                                  $q2->whereNull('status')->where('is_active', true);
                              });
                        })
                        ->whereHas('page', function ($pq) {
                            $pq->where('in_navbar', true)
                               ->where(function ($sq) {
                                   $sq->where('status', 'publish')
                                      ->orWhere(function ($sq2) {
                                          $sq2->whereNull('status')->where('is_published', true);
                                      });
                               });
                        })
                        ->orderBy('order', 'asc')
                        ->get();

                    $view->with('navbarProjects', $navbarProjects);
                } else {
                    $view->with('navbarProjects', collect());
                }
            } catch (\Throwable $e) {
                $view->with('navbarProjects', collect());
            }
        });
    }
}
