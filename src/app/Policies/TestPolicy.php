<?php

namespace App\Policies;

use App\Models\Test;
use App\Models\User;

class TestPolicy extends BasePolicy
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
        return $user->hasPermissionTo(Test::READ_TEST);
    }

    public function view(User $user): bool
    {
        return $user->hasPermissionTo(Test::READ_TEST);
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo(Test::CREATE_TEST);
    }

    public function update(User $user, $test): bool
    {
        return $user->hasPermissionTo(Test::UPDATE_TEST) && $this->checkUserMatch($user, $test);
    }

    public function delete(User $user, $test): bool
    {
        return $user->hasPermissionTo(Test::DELETE_TEST) && $this->checkUserMatch($user, $test);
    }

    public function rate(User $user, $test): bool
    {
        return $user->hasPermissionTo(Test::RATE_TEST);
    }
}
