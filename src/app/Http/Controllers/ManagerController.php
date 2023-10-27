<?php

namespace App\Http\Controllers;

use App\DTO\UserDTO;
use App\Http\Requests\ManagerCreateRequest;
use App\Http\Requests\ManagerUpdateRequest;
use App\Http\Resources\ManagerResource;
use App\Models\Role;
use App\Models\User;
use App\Repositories\ManagerRepository;
use Illuminate\Http\JsonResponse;

class ManagerController extends Controller
{
    public function __construct(
        private ManagerRepository $managerRepository
    ) {
        $this->authorizeResource(User::class, 'manager');
    }

    public function index(): JsonResponse
    {
        return response()->json(
            ManagerResource::collection($this->managerRepository->index($this->getUser()))
        );
    }


    public function store(ManagerCreateRequest $request): JsonResponse
    {
        $user = new UserDTO($request->validated());

        return response()->json(
            new ManagerResource($this->managerRepository->create($user))
        );
    }

    public function show(User $manager): JsonResponse
    {
        return response()->json(
            new ManagerResource($this->managerRepository->show($manager))
        );
    }


    public function update(ManagerUpdateRequest $request, User $manager): JsonResponse
    {
        $user = new UserDTO($request->validated());

        return response()->json(
            new ManagerResource($this->managerRepository->update($manager, $user->toArray()))
        );
    }

    public function destroy(User $manager): JsonResponse
    {
        $this->managerRepository->delete($manager);

        return response()->json();
    }
}
