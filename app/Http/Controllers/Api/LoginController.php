<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Contracts\Auth\Factory;
use Illuminate\Routing\Controller;
use Illuminate\Routing\ResponseFactory;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class LoginController
 * @package Kodear\LaravelUsers\Controllers\Api
 */
class LoginController extends Controller
{
    /**
     * @var \Illuminate\Contracts\Auth\Factory|\Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard
     */
    protected $auth;

    /**
     * @var ResponseFactory
     */
    protected $responseFactory;

    /**
     * AuthController constructor.
     * @param Factory $auth
     * @param ResponseFactory $responseFactory
     */
    public function __construct(Factory $auth, ResponseFactory $responseFactory)
    {
        $this->auth = $auth->guard(null);
        $this->responseFactory = $responseFactory;

        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only('email', 'password');
    }

    /**
     * Handles Login Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $this->credentials($request);

        if ($this->auth->attempt($credentials)) {
            /** @var User $user */
            $user = $this->auth->user();

            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            $token->save();

            return $this->responseFactory->json([
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString()
            ]);
        } else {
            return $this->responseFactory->json(['error' => 'UnAuthorised'], 401);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $this->auth->logout();
        return $this->responseFactory->json([]);
    }
}