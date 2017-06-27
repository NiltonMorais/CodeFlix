<?php

namespace CodeFlix\Providers;

use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use CodeFlix\Models\Video;
use Dingo\Api\Exception\Handler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\DuskServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Video::updated(function ($video) {
            if (!$video->completed) {
                if ($video->file != null && $video->thumb != null && $video->duration != null) {
                    $video->completed = true;
                    $video->save();
                }
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'prod') {
            $this->app->register(IdeHelperServiceProvider::class);
            $this->app->register(DuskServiceProvider::class);
        }
        $handler = app(Handler::class);
        $handler->register(function(AuthenticationException $exception){
           return response()->json([
               'error' => 'Unauthenticated',
               'message' => 'Usuário não autenticado'
           ],401);
        });
    }
}
