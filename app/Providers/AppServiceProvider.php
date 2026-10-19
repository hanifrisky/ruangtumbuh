<?php

namespace App\Providers;

use App\Models\Lesson;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(['layouts.konseli', 'konseli.*'], function ($view) {
            $hasLessons = false;
            try {
                if (Schema::hasTable('lessons')) {
                    $hasLessons = Lesson::exists();
                }
            } catch (\Throwable $e) {
                $hasLessons = false;
            }
            $view->with('hasLessons', $hasLessons);
        });
    }
}
