<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use JWTAuth;

class UserService implements UserServiceInterface
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * get list
     *
     * @param array $params
     * @return void
     */
    public function getList($params)
    {
        $query = $this->user->where('id', '!=', JWTAuth::user()->id)->orderBy('id', 'desc');
        if (isset($params['username'])) {
            return $query->where('username', 'like', '%' . $params['username'] . '%')->paginate();
        }
        return $query->paginate();
    }

    /**
     * create
     *
     * @param array $params
     * @return void
     */
    public function register($params)
    {
        $this->user->create([
            'fullname' => $params['fullname'],
            'username' => $params['username'],
            'email' => $params['email'],
            'phone' => $params['phone'],
            'password' => Hash::make($params['password']),
            'permission' => $params['permission'] ?? 0
        ]);
    }

    /**
     * update user profile
     *
     * @param array $params
     * @return void
     */
    public function updateUserProfile($params)
    {
        $this->user->findOrFail(JWTAuth::user()->id)->update($params);
    }

    public function delete($id)
    {
        $this->user->findOrFail($id)->delete();
    }
}
