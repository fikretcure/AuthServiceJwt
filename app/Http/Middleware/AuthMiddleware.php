<?php

namespace App\Http\Middleware;

use App\Enums\JwtTypeEnum;
use App\Helpers\AuthenticationHelpers;
use App\Helpers\JwtHelpers;
use App\Traits\ResponseTrait;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Auth;
use Throwable;

/**
 *
 */
class AuthMiddleware
{
    use ResponseTrait;

    /**
     *
     */
    public function __construct()
    {
    }


    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        try {
            $user = JWT::decode(request()->header(JwtTypeEnum::BEARER->value), new Key(env("JWT_KEY"), 'HS256'));
            (new AuthenticationHelpers())->setCacheToken(request()->header(JwtTypeEnum::BEARER->value), request()->header(JwtTypeEnum::REFRESH->value));
            Auth::loginUsingId($user->user_id);
            return $next($request);
        } catch (Throwable $e) {
          (new AuthenticationHelpers())->setCacheToken(request()->header(JwtTypeEnum::BEARER->value), request()->header(JwtTypeEnum::REFRESH->value));
            return $this->failMes("Geçersiz token");
        }
    }
}
