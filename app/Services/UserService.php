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
        $query = $this->user->where('id', '!=', JWTAuth::user()->id)->orderByDesc('created_at');
        $username = $params['username'] ?? null;
        $fullname = $params['fullname'] ?? null;
        $email = $params['email'] ?? null;
        $permission = $params['permission'] ?? null;

        if ($username != null) {
            $query->where('username', 'like', '%' . $username . '%');
        }

        if ($fullname != null) {
            $query->where('fullname', 'like', '%' . $fullname . '%');
        }

        if ($email != null) {
            $query->where('email', 'like', '%' . $email . '%');
        }

        if ($permission != null) {
            $query->where('permission', $permission);
        }

        $query = $query->paginate();

        return [
            'data' => $query->map(function ($item) {
                return $item->getUserResponse();
            }),
            'per_page' => $query->perPage(),
            'total' => $query->total(),
            'current_page' => $query->currentPage(),
            'last_page' => $query->lastPage(),
        ];
    }

    /**
     * create
     *
     * @param array $params
     * @return void
     */
    public function register($params)
    {
        return $this->user->create([
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

    public function forgetPassword($params)
    {
        $user = $this->user->where('email', $params['email'])->first();
        $this->user->findOrFail($user->id)->update([
            'password' => Hash::make($params['password'])
        ]);
        return $user;
    }
}
