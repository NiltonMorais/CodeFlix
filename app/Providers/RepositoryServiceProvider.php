<?php

namespace CodeFlix\Providers;

use CodeFlix\Repositories\Interfaces\UserRepository;
use CodeFlix\Repositories\UserRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepository::class,UserRepositoryEloquent::class);
        $this->app->bind(\CodeFlix\Repositories\Interfaces\CategoryRepository::class, \CodeFlix\Repositories\CategoryRepositoryEloquent::class);
        $this->app->bind(\CodeFlix\Repositories\Interfaces\SerieRepository::class, \CodeFlix\Repositories\SerieRepositoryEloquent::class);
        $this->app->bind(\CodeFlix\Repositories\Interfaces\VideoRepository::class, \CodeFlix\Repositories\VideoRepositoryEloquent::class);
        $this->app->bind(\CodeFlix\Repositories\Interfaces\PlanRepository::class, \CodeFlix\Repositories\PlanRepositoryEloquent::class);
        $this->app->bind(\CodeFlix\Repositories\Interfaces\OrderRepository::class, \CodeFlix\Repositories\OrderRepositoryEloquent::class);
        $this->app->bind(\CodeFlix\Repositories\Interfaces\SubscriptionRepository::class, \CodeFlix\Repositories\SubscriptionRepositoryEloquent::class);
        $this->app->bind(\CodeFlix\Repositories\Interfaces\PaypalWebProfileRepository::class, \CodeFlix\Repositories\PaypalWebProfileRepositoryEloquent::class);
        //:end-bindings:
    }
}
