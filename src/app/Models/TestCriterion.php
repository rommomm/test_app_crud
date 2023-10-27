<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestCriterion extends Model
{
    use HasFactory;

    protected $table = 'test_criteria';
    protected $fillable = ['score', 'criterion'];

    public static function getCriterionByScore($score)
    {
        return self::where('score', $score)->value('criterion');
    }

    public static function getAllScores()
    {
        return self::pluck('score')->toArray();
    }
}
