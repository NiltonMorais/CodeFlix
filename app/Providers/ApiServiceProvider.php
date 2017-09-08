<?php

namespace CodeFlix\Providers;

use CodeFlix\Exceptions\SubscriptionInvalidException;
use CodeFlix\Models\Video;
use CodeFlix\Transformers\VideoTransformer;
use Dingo\Api\Exception\Handler;
use Dingo\Api\Transformer\Factory;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Exceptions\JWTException;

class ApiServiceProvider extends ServiceProvider
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
        $this->registerHandlers();
        $this->registerTransformers();
    }

    private function registerTransformers()
    {
        $transformer = app(Factory::class);
        $transformer->register(Video::class,VideoTransformer::class);
    }

    private function registerHandlers()
    {
        $handler = app(Handler::class);
        $handler->register(function (AuthenticationException $exception) {
            return response()->json([
                'error' => 'Unauthenticated'
            ], 401);
        });
        $handler->register(function (JWTException $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], 401);
        });
        $handler->register(function (ValidationException $exception) {
            return response()->json([
                'error' => $exception->getMessage(),
                'validation_errors' => $exception->validator->getMessageBag()->toArray()
            ], 422);
        });
        $handler->register(function (SubscriptionInvalidException $exception) {
            return response()->json([
                'error' => 'subscription_valid_not_found',
                'message' => $exception->getMessage()
            ], 403);
        });
    }
}
