<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class AuthService {
    protected $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function loginUser(string $email, string $password) {
        $user = $this->userRepository->findByEmail($email);

        if (!$user || !Hash::check($password, $user->password)) {
            return false;
        }

        return $user->createToken($user->name.'-token')->plainTextToken;
    }

    public function logoutUser($user) {
        $user->tokens()->delete();
        return true;
    }
}
