<?php

namespace App\Providers;

<<<<<<< HEAD
=======
use Illuminate\Support\Facades\Vite;
>>>>>>> cc2282c4008e976e311c2f097f7febbee9aa6c86
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
<<<<<<< HEAD
        //
=======
        Vite::prefetch(concurrency: 3);
>>>>>>> cc2282c4008e976e311c2f097f7febbee9aa6c86
    }
}
