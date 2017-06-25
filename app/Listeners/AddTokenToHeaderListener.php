<?php

namespace CodeFlix\Listeners;

use Dingo\Api\Event\ResponseWasMorphed;
use Tymon\JWTAuth\JWT;

class AddTokenToHeaderListener
{
    /**
     * @var JWT
     */
    private $jwt;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(JWT $jwt)
    {
        $this->jwt = $jwt;
    }

    /**
     * Handle the event.
     *
     * @param  ResponseWasMorphed  $event
     * @return void
     */
    public function handle(ResponseWasMorphed $event)
    {
        $token = $this->jwt->getToken();
        if($token){
            $event->response->headers->set('Authorization',"Bearer {$token->get()}");
        }
    }
}
