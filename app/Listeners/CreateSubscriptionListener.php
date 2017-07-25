<?php

namespace CodeFlix\Listeners;

use CodeFlix\Models\Order;
use CodeFlix\Repositories\Interfaces\SubscriptionRepository;
use Prettus\Repository\Events\RepositoryEntityCreated;

class CreateSubscriptionListener
{
    /**
     * @var SubscriptionRepository
     */
    private $repository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(SubscriptionRepository $repository)
    {
        //
        $this->repository = $repository;
    }

    /**
     * Handle the event.
     *
     * @param  RepositoryEntityCreated $event
     * @return void
     */
    public function handle(RepositoryEntityCreated $event)
    {
        $model = $event->getModel();
        if(!($model instanceof Order)){
            return;
        }

        $this->repository->create([
            'order_id' => $model->id,
            'plan_id' => 1
        ]);
    }
}
