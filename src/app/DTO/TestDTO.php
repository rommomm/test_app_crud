<?php

namespace App\DTO;

use App\Models\TestCriterion;
use App\Models\User;

class TestDTO
{
    public $full_name;
    public $location;
    public $score;
    public $criterion;
    public $user_id;
    public $manager_id;

    public function __construct(array $data, User $user)
    {
        $this->full_name = $data['full_name'] ?? null;
        $this->location = $data['location'] ?? null;
        $this->score = $data['score'] ?? null;
        $this->criterion = isset($data['score']) ? TestCriterion::getCriterionByScore($data['score']) : null;
        $this->user_id = $user->getUserId();
        $this->manager_id = $user->getManagerId();
    }

    public function toArray(): array
    {
        return array_filter([
            'full_name' => $this->full_name,
            'location' => $this->location,
            'score' => $this->score,
            'criterion' => $this->criterion,
            'user_id' => $this->user_id,
            'manager_id' => $this->manager_id,
        ], static fn($value) => $value !== null);
    }
}
