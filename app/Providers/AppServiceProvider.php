<?php

namespace CodeFlix\Providers;

use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Code\Validator\Cpf;
use CodeFlix\Models\Video;
use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\DuskServiceProvider;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

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

        \Validator::extend('cpf', function ($attributes, $value, $parameters, $validator) {
            return (new Cpf())->isValid($value);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ApiContext::class, function () {
            $apiContext = new ApiContext(new OAuthTokenCredential(
                env('PAYPAL_CLIENT_ID'),
                env('PAYPAL_CLIENT_SECRET')
            ));
            $apiContext->setConfig([
                'http.CURLOPT_CONNECTIONTIMEOUT' => 45
            ]);
            return $apiContext;
        });

        if ($this->app->environment() !== 'prod') {
            $this->app->register(IdeHelperServiceProvider::class);
            $this->app->register(DuskServiceProvider::class);
        }

    }
}
