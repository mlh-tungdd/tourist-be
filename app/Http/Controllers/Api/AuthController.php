<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use JWTAuthException;
use App\Services\UserServiceInterface;

class AuthController extends ApiController
{
    protected $response;
    protected $user;

    /**
     * construct function
     *
     * @param UserServiceInterface $user
     * @param ApiResponse $response
     */
    public function __construct(ApiResponse $response, UserServiceInterface $user)
    {
        $this->response = $response;
        $this->user = $user;
    }

    /**
     * Login function
     *
     * @param LoginRequest $request
     * @return void
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('username', 'password');
        $token = null;
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return $this->response->errorNotFound('Tài khoản hoặc mật khẩu không đúng');
            }
        } catch (JWTAuthException $e) {
            return $this->response->errorExpiredToken();
        }
        return $this->response->withData([
            'token' => $token,
            'type' => 'Bearer Token',
            'user' => Auth::user(),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate($request->token);

            return $this->response->withMessage('User logged out successfully');
        } catch (JWTException $exception) {
            return $this->response->errorExpiredToken();
        }
    }

    /**
     * register function
     *
     * @param RegisterRequest $request
     * @return void
     */
    public function register(RegisterRequest $request)
    {
        try {
            $this->user->register($request->all());
            return $this->response->withCreated();
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }
}