<?php

namespace App\Services;

interface UserServiceInterface
{
    public function getList($params);

    public function delete($id);

    public function register($params);

    public function updateUserProfile($params);

    public function forgetPassword($params);
}
