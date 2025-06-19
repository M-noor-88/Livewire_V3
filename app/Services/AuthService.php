<?php

// app/Services/AuthService.php

namespace App\Services;

use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthService
{
    protected AuthRepository $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function register(array $data)
    {
        return $this->authRepository->createUser($data);
    }

    public function login(array $credentials)
    {
        $user = $this->authRepository->findUserByEmail($credentials['email']);

        if (!$user || !$this->authRepository->checkPassword($user, $credentials['password'])) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        Auth::login($user);
    }

    public function logout()
    {
        Auth::logout();
    }

    public function user()
    {
        return Auth::user();
    }
}
