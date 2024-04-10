<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository {
    public function createUser(array $userData) {
        $userData['password'] = Hash::make($userData['password']);
        return User::create($userData);
    }

    public function findByEmail(string $email) {
        return User::where('email', $email)->first();
    }
}
