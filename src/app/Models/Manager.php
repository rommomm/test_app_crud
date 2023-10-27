<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    public const CREATE_MANAGER = 'create manager';
    public const READ_MANAGER = 'read manager';
    public const UPDATE_MANAGER = 'update manager';
    public const DELETE_MANAGER = 'delete manager';
}
