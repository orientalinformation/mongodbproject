<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
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

        $this->app->singleton(
            \App\Repositories\Post\PostRepositoryInterface::class,
            \App\Repositories\Post\PostEloquentRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Topic\TopicRepositoryInterface::class,
            \App\Repositories\Topic\TopicEloquentRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Source\SourceRepositoryInterface::class,
            \App\Repositories\Source\SourceEloquentRepository::class
        );

        $this->app->singleton(
          \App\Repositories\Category\CategoryRepositoryInterface::class,
          \App\Repositories\Category\CategoryEloquentRepository::class
        );
    }
}
