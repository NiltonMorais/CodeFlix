<?php

namespace CodeFlix\Http\Controllers\Api;

use CodeFlix\Http\Controllers\Controller;
use CodeFlix\Repositories\Interfaces\UserRepository;
use Illuminate\Http\Request;
use Laravel\Socialite\Two\User;

class RegisterUsersController extends Controller
{
    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(Request $request)
    {
        $authorization = $request->header('Authorization');
        $accessToken = str_replace('Bearer ','',$authorization);
        $facebook = \Socialite::driver('facebook');
        /** @var User $userSocial */
        $userSocial = $facebook->userFromToken($accessToken);
        $user = $this->repository->findByField('email',$userSocial->email)->first();
        if(!$user){
            \CodeFlix\Models\User::unguard();
            $user = $this->repository->create([
                'name' => $userSocial->name,
                'email' => $userSocial->email,
                'role' => \CodeFlix\Models\User::ROLE_CLIENT,
                'verified' => true
            ]);
            \CodeFlix\Models\User::reguard();
        }

        return ['token'=> \Auth::guard('api')->tokenById($user->id)];


    }
}
