<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
    }

    /**
     * Register binding services
     */
    private function registerBindings()
    {
        $this->app->singleton(
            \App\Repositories\Book\BookRepositoryInterface::class,
            \App\Repositories\Book\BookEloquentRepository::class
        );
    }
}
