<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class EnvatoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        require_once app_path() . '/Helpers/Envato/Book.php';
        require_once app_path() . '/Helpers/Envato/Ulities.php';
        require_once app_path() . '/Helpers/Envato/Category.php';
        require_once app_path() . '/Helpers/Envato/ObjectService.php';
    }
}
