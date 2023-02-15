<?php

namespace App\Http\Middleware;

use App\Enums\JwtTypeEnum;
use App\Helpers\AuthenticationHelpers;
use App\Helpers\JwtHelpers;
use App\Traits\ResponseTrait;
use Closure;
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
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $key = new Key(env("JWT_KEY"), 'HS256');
        $header_refresh = request()->header(JwtTypeEnum::REFRESH->value);

        try {
            $user = JWT::decode(request()->header(JwtTypeEnum::BEARER->value), $key);
            (new AuthenticationHelpers())->setCacheToken(request()->header(JwtTypeEnum::BEARER->value), $header_refresh);
            $this->loginUsingId($user->user_id);
            return $next($request);
        } catch (Throwable $e) {
            try {
                $user = JWT::decode(request()->header(JwtTypeEnum::REFRESH->value), $key);
                (new AuthenticationHelpers())->setCacheToken((new JwtHelpers())->store(JwtTypeEnum::BEARER, $user->user_id), $header_refresh);
                $this->loginUsingId($user->user_id);
                return $next($request);
            } catch (Throwable $e) {
                return $this->failMes("Geçersiz token")->send();
            }
        }
    }

    /**
     * @param $id
     * @return void
     */
    private function loginUsingId($id)
    {
        Auth::loginUsingId($id);
    }
}
