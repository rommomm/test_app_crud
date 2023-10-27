<?php

namespace App\Repositories;

use App\DTO\TestDTO;
use App\Models\Test;
use App\Models\User;

class TestRepository extends BaseRepository
{

    public function __construct(Test $model)
    {
        parent::__construct($model);
    }

    public function updateTest(Test $test, array $data, User $user): Test
    {
        $updatedTest = new TestDTO($data, $user);

        return $this->update($test, $updatedTest->toArray());
    }
}
