<?php

namespace App\Policies;

use App\Models\User;

abstract class BasePolicy
{
    protected function checkUserMatch(User $user, $model): bool
    {
        return $user->id === $model->user_id;
    }
}
