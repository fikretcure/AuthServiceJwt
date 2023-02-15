<?php

namespace App\Helpers;

use App\Enums\JwtTypeEnum;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

/**
 *
 */
class JwtHelpers
{

    /**
     * @var mixed
     */
    private mixed $secret_key;


    /**
     *
     */
    public function __construct()
    {
        $this->secret_key = env("JWT_KEY");
    }


    /**
     * @param $type
     * @param $user_id
     * @param null $remember_me
     * @return string
     */
    public function store($type, $user_id, $remember_me = null): string
    {
        if ($type == JwtTypeEnum::BEARER) {
            $exp = now()->addMinutes(5);
        } else if ($type == JwtTypeEnum::REFRESH) {
            $exp = !$remember_me ? now()->addHours(5) : now()->addDays(5);
        }

        $payload = [
            'iss' => env("APP_URL"),
            'aud' => env("APP_URL"),
            'iat' => now()->timestamp,
            'exp' => ($exp)->timestamp,
            'user_id' => $user_id
        ];

        return JWT::encode($payload, $this->secret_key, 'HS256');
    }
}
