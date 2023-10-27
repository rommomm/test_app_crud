<?php

namespace App\Repositories;

use App\DTO\UserDTO;
use App\Models\Role;
use App\Models\User;

class ManagerRepository extends BaseRepository
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository, User $model)
    {
        parent::__construct($model);
        $this->userRepository = $userRepository;
    }

    public function index(User $user)
    {
        return $user->managers();
    }

    public function create(UserDTO|array $data): User
    {
        $user = $this->userRepository->create($data);
        $user->assignRole(Role::MANAGER);

        return $user;
    }
}
