<?php

namespace App\Http\Controllers;


use App\Enums\JwtTypeEnum;
use App\Helpers\AuthenticationHelpers;
use App\Helpers\JwtHelpers;
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
     * @param JwtHelpers $jwt
     * @return JsonResponse
     */
    public function login(AuthenticationLoginRequest $request, JwtHelpers $jwt): JsonResponse
    {
        $user = $this->user_repository->showByEmail($request->validated("email"));
        if (Hash::check($request->password, $user->password)) {
            (new AuthenticationHelpers())->setCacheToken($jwt->store(JwtTypeEnum::BEARER, $user->id), $jwt->store(JwtTypeEnum::REFRESH, $user->id));
            return $this->success()->send();
        }
        return $this->failMes("Kullanıcı Bilgilerini Tekrar Girerek Deneyiniz !")->send();
    }

    /**
     * @return JsonResponse
     */
    public function show(): JsonResponse
    {
        return $this->success($this->user_repository->show(Auth::id()))->send();
    }
}
