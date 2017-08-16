<?php

namespace CodeFlix\Listeners;

use CodeFlix\Models\PaypalWebProfile;
use CodeFlix\Repositories\Interfaces\PaypalWebProfileRepository;
use Prettus\Repository\Events\RepositoryEntityCreated;
use CodeFlix\PayPal\WebProfileClient;

class CreatePaypalWebProfileListener
{
    /**
     * @var WebProfileClient
     */
    private $webProfileClient;
    /**
     * @var PaypalWebProfileRepository
     */
    private $webProfileRepository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(WebProfileClient $webProfileClient, PaypalWebProfileRepository $webProfileRepository)
    {
        $this->webProfileClient = $webProfileClient;
        $this->webProfileRepository = $webProfileRepository;
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
        if(!($model instanceof PaypalWebProfile)){
            return;
        }

        $paypalWebProfile = $this->webProfileClient->create($model);

        \Config::set('webprofile_created',true);
        $this->webProfileRepository->update([
            'code' => $paypalWebProfile->getId()
        ], $model->id);
    }
}
