<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UserRequest;
use App\Services\UserServiceInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use JWTAuth;

class UserController extends ApiController
{
    protected $userService;
    protected $response;

    /**
     * construct function
     *
     * @param UserServiceInterface $user
     * @param ApiResponse $response
     */
    public function __construct(UserServiceInterface $userService, ApiResponse $response)
    {
        $this->userService = $userService;
        $this->response = $response;
    }

    /**
     * get list
     *
     * @return json
     */
    public function getList(Request $request)
    {
        $list = $this->userService->getList($request->all());
        return $this->response->withData($list);
    }

    public function delete($id)
    {
        try {
            $this->userService->delete($id);
            return $this->response->withMessage('Xoá thành công');
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }

    /**
     * get user profile
     *
     * @param Request $request
     * @return void
     */
    public function showProfile(Request $request)
    {
        $user = JWTAuth::toUser($request->token);
        return $this->response->withData($user);
    }

    /**
     * edit user profile
     *
     * @param UserRequest $request
     * @return void
     */
    public function editProfile(UserRequest $request)
    {
        try {
            $this->userService->updateUserProfile($request->all());
            return $this->response->withMessage('Cập nhật thành công');
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }

    /**
     * change password user profile
     *
     * @param ChangePasswordRequest $request
     * @return void
     */
    public function changePasswordProfile(ChangePasswordRequest $request)
    {
        if (Hash::check($request->old_password, JWTAuth::user()->password)) {
            try {
                $this->userService->updateUserProfile([
                    'password' => Hash::make($request->new_password)
                ]);
                return $this->response->withMessage('Thay đổi password thành công');
            } catch (Exception $ex) {
                return $this->response->errorForbidden();
            }
        } else {
            return $this->response->errorUnauthorized('Sai mật khẩu');
        }
    }
}
