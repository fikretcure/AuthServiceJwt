<?php

namespace App\Http\Controllers;


use App\Helpers\RequestMergeHelper;
use App\Http\Repositories\TokenRepository;
use App\Http\Repositories\UserRepository;
use App\Http\Requests\AuthenticationLoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 *
 */
class AuthenticationController extends Controller
{

    /**
     *
     */
    public function __construct()
    {
        $this->user_repository = new UserRepository;
    }

    /**
     * @param AuthenticationLoginRequest $request
     * @return JsonResponse
     */
    public function login(AuthenticationLoginRequest $request): JsonResponse
    {
        $user = $this->user_repository->showByEmail($request->validated("email"));


        return $this->success()->send();

    }

    /**
     * @return JsonResponse
     */
    public function show(): JsonResponse
    {
        return $this->success()->send();

        return $this->success(Auth::user())->send();
    }
}
