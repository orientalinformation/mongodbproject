<?php

namespace App\Providers;

use App\Repositories\Web\WebRepositoryInterface;
use Illuminate\Support\Facades\App;
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

        // get controller action name to view
        app('view')->composer('*', function ($view) {
            $action = app('request')->route()->getAction();
            $controller = class_basename($action['controller']);
            list($controller, $action) = explode('@', $controller);
            
            $view->with(compact('controller', 'action'));
        });
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
            \App\Repositories\Rss\RssRepositoryInterface::class,
            \App\Repositories\Rss\RssEloquentRepository::class
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
            \App\Repositories\Library\LibraryRepositoryInterface::class,
            \App\Repositories\Library\LibraryEloquentRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Role\RoleRepositoryInterface::class,
            \App\Repositories\Role\RoleEloquentRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Permission\PermissionRepositoryInterface::class,
            \App\Repositories\Permission\PermissionEloquentRepository::class
        );               

        $this->app->singleton(
            \App\Repositories\PermissionRole\PermissionRoleRepositoryInterface::class,
            \App\Repositories\PermissionRole\PermissionRoleEloquentRepository::class
        );

        $this->app->singleton(
            \App\Repositories\User\UserRepositoryInterface::class,
            \App\Repositories\User\UserEloquentRepository::class
        );

        $this->app->singleton(
            \App\Repositories\UserSocial\UserSocialRepositoryInterface::class,
            \App\Repositories\UserSocial\UserSocialEloquentRepository::class
        );        

        $this->app->singleton(
            \App\Repositories\AccountManager\AccountManagerRepositoryInterface::class,
            \App\Repositories\AccountManager\AccountmanagerEloquentRepository::class
        );    

        $this->app->singleton(
            \App\Repositories\PartnerManager\PartnerManagerRepositoryInterface::class,
            \App\Repositories\PartnerManager\PartnermanagerEloquentRepository::class
        );   

        $this->app->singleton(
            \App\Repositories\Discussion\DiscussionRepositoryInterface::class,
            \App\Repositories\Discussion\DiscussionEloquentRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Product\ProductRepositoryInterface::class,
            \App\Repositories\Product\ProductEloquentRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Research\ResearchRepositoryInterface::class,
            \App\Repositories\Research\ResearchEloquentRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Web\WebRepositoryInterface::class,
            \App\Repositories\Web\WebEloquentRepository::class
        );

        $this->app->singleton(
            \App\Repositories\BookDetail\BookDetailRepositoryInterface::class,
            \App\Repositories\BookDetail\BookDetailEloquentRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Bibliotheque\BibliothequeRepositoryInterface::class,
            \App\Repositories\Bibliotheque\BibliothequeEloquentRepository::class
        );

        $this->app->singleton(
            \App\Repositories\ReadAfter\ReadAfterRepositoryInterface::class,
            \App\Repositories\ReadAfter\ReadAfterEloquentRepository::class
        );

        $this->app->singleton(
            \App\Repositories\LibraryDetail\LibraryDetailRepositoryInterface::class,
            \App\Repositories\LibraryDetail\LibraryDetailEloquentRepository::class
        );

        $this->app->singleton(
            \App\Repositories\ProductDetail\ProductDetailRepositoryInterface::class,
            \App\Repositories\ProductDetail\ProductDetailEloquentRepository::class
        );
    }
}
