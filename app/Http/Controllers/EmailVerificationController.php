<?php

namespace CodeFlix\Http\Controllers;

use CodeFlix\Repositories\Interfaces\UserRepository;
use Illuminate\Support\Facades\Request;
use Jrean\UserVerification\Traits\VerifiesUsers;

class EmailVerificationController extends Controller
{
    use VerifiesUsers;

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function redirectAfterVerification()
    {
        $this->loginUser();
        return route('user_settings.edit');
    }

    protected function loginUser()
    {
        $email = Request::get('email');
        $user = $this->userRepository->findByField('email',$email)->first();
        \Auth::login($user);
    }

}
