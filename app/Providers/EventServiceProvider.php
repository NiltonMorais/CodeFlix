<?php

namespace CodeFlix\Providers;

use CodeFlix\Listeners\AddTokenToHeaderListener;
use Dingo\Api\Event\ResponseWasMorphed;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        ResponseWasMorphed::class => [
            AddTokenToHeaderListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
