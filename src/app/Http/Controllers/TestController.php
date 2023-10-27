<?php

namespace App\Http\Controllers;

use App\DTO\TestDTO;
use App\Http\Requests\TestCreateRequest;
use App\Http\Requests\TestRateRequest;
use App\Http\Requests\TestUpdateRequest;
use App\Http\Resources\TestResource;
use App\Models\Test;
use App\Repositories\TestRepository;
use Illuminate\Http\JsonResponse;

class TestController extends Controller
{
    public function __construct(
        private TestRepository $testRepository
    ) {
        $this->authorizeResource(Test::class, 'test');
    }

    public function index(): JsonResponse
    {
        return response()->json(
            TestResource::collection($this->testRepository->index($this->getUser()))
        );
    }


    public function store(TestCreateRequest $request): JsonResponse
    {
        $test = new TestDTO($request->validated(), $this->getUser());

        return response()->json(
            new TestResource($this->testRepository->create($test->toArray()))
        );
    }

    public function show(Test $test): JsonResponse
    {
        return response()->json(
            new TestResource($this->testRepository->show($test))
        );
    }

    public function update(TestUpdateRequest $request, Test $test): JsonResponse
    {
        return response()->json(
            new TestResource($this->testRepository->updateTest($test, $request->validated(), $this->getUser()))
        );
    }

    public function destroy(Test $test): JsonResponse
    {
        $this->testRepository->delete($test);

        return response()->json();
    }

    public function rate(TestRateRequest $request, Test $test): JsonResponse
    {
        $this->authorize('rate', $test);

        return response()->json(
            new TestResource($this->testRepository->updateTest($test, $request->validated(), $this->getUser()))
        );
    }
}
