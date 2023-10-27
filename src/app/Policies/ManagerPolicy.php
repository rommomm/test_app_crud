<?php

namespace App\Policies;

use App\Models\Manager;
use App\Models\Role;
use App\Models\User;

class ManagerPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(Manager::READ_MANAGER);
    }

    public function view(User $user): bool
    {
        return $user->hasPermissionTo(Manager::READ_MANAGER);
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo(Manager::CREATE_MANAGER);
    }

    public function update(User $user, $manager): bool
    {
        return $user->hasPermissionTo(Manager::UPDATE_MANAGER) && $manager->hasRole(Role::MANAGER);
    }

    public function delete(User $user, $manager): bool
    {
        return $user->hasPermissionTo(Manager::DELETE_MANAGER) && $manager->hasRole(Role::MANAGER);
    }
}
