<?php

namespace App\Repositories;

use App\DTO\UserDTO;
use App\Exceptions\CredentialInvalidException;
use App\Models\Role;
use Laravel\Socialite\Facades\Socialite;

class AuthRepository
{
    public function __construct(
        private UserRepository $userRepository,
    ) {
    }

    public function signUp(UserDTO $userDTO): string
    {
        $user = $this->userRepository->create($userDTO);
        $user->assignRole(Role::ADMIN);

        return $user->createToken($userDTO->email)->plainTextToken;
    }

    /**
     * @throws CredentialInvalidException
     */
    public function signIn(UserDTO $userDTO): string
    {
        if (!auth()->attempt($userDTO->signInCredentials())) {
            throw new CredentialInvalidException();
        }

        return $this->userRepository->getUserByEmail($userDTO->email)->createToken($userDTO->email)->plainTextToken;
    }

    public function signOut(): void
    {
        session()->flush();
        auth()->user()?->currentAccessToken()->delete();
    }
}
