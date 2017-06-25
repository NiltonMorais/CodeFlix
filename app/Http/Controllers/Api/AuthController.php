<?php

namespace CodeFlix\Http\Controllers\Api;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use CodeFlix\Http\Controllers\Controller;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    public function accessToken(Request $request)
    {
        $this->validateLogin($request);
        $credentials = $this->credentials($request);
        if($token = \Auth::guard('api')->attempt($credentials)){
            return $this->sendLoginResponse($request, $token);
        }
        return $this->sendFailedLoginResponse($request);
    }

    public function refreshToken(Request $request)
    {
        $token = \Auth::guard('api')->refresh();
        return $this->sendLoginResponse($request, $token);
    }

    protected function sendLoginResponse(Request $request, $token)
    {
        return response()->json([
            'token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        \Auth::guard('api')->logout();
        return response()->json([],204);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        return response()->json([
            'error' => \Lang::get('auth.failed')
        ],400);
    }
}
