<?php

namespace App\Helpers;

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
     * @param $remember_me
     * @return string
     */
    public function store($type, $remember_me = null): string
    {
        if ($type == "bearer") {
            $exp = now()->addMinutes(5);
        } else if ($type == "refresh") {
            $exp = !$remember_me ? now()->addHours(5) : now()->addDays(5);
        }

        $payload = [
            'iss' => env("APP_URL"),
            'aud' => env("APP_URL"),
            'iat' => now(),
            'exp' => $exp
        ];

        return JWT::encode($payload, $this->secret_key, 'HS256');
    }
}
