<?php

// app/Repositories/AuthRepository.php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthRepository
{
    public function createUser(array $data): User
    {
        return User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function findUserByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function checkPassword(User $user, string $plainPassword): bool
    {
        return Hash::check($plainPassword, $user->password);
    }
}
