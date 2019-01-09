<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
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

        $this->app->singleton(
          \App\Repositories\Category\CategoryRepositoryInterface::class,
          \App\Repositories\Category\CategoryEloquentRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Pin\PinRepositoryInterface::class,
            \App\Repositories\Pin\PinEloquentRepository::class
        );
                    
        $this->app->singleton(
            \App\Repositories\User\UserRepositoryInterface::class,
            \App\Repositories\User\UserEloquentRepository::class
        );
    }
}
