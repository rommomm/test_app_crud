<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Test extends Model
{
    use HasFactory;

    public const CREATE_TEST = 'create test';
    public const READ_TEST = 'read test';
    public const UPDATE_TEST = 'update test';
    public const DELETE_TEST = 'delete test';
    public const RATE_TEST = 'rate test';


    protected $fillable = [
        'full_name',
        'location',
        'score',
        'criterion',
        'manager_id',
        'user_id',
    ];

    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
