<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function getAllUsers()
    {
        return User::all();
    }
    public function getUserById($user_id)
    {
        $user = User::find($user_id);

        return $user;
    }
    public function getUserType($user_id)
    {
        $user = User::find($user_id); // conditions to get user type

        return $user->user_type;
    }
}
