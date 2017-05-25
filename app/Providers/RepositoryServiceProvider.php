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
        //:end-bindings:
    }
}
