<?php

namespace CodeFlix\Listeners;

use CodeFlix\Models\PaypalWebProfile;
use CodeFlix\PayPal\WebProfileClient;
use Prettus\Repository\Events\RepositoryEntityUpdated;

class UpdatePaypalWebProfileListener
{
    /**
     * @var WebProfileClient
     */
    private $webProfileClient;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(WebProfileClient $webProfileClient)
    {
        $this->webProfileClient = $webProfileClient;
    }

    /**
     * Handle the event.
     *
     * @param  RepositoryEntityUpdated $event
     * @return void
     */
    public function handle(RepositoryEntityUpdated $event)
    {
        if(!\Config::get('webprofile_created')){
            return;
        }

        $model = $event->getModel();
        if (!($model instanceof PaypalWebProfile)) {
            return;
        }

        $this->webProfileClient->update($model);
    }
}
