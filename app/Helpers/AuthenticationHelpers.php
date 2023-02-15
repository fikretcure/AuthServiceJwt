<?php

namespace App\Helpers;

use App\Enums\JwtTypeEnum;
use Illuminate\Support\Facades\Cache;

/**
 *
 */
class AuthenticationHelpers
{
    /**
     * @param $bearer
     * @param $refresh
     * @return void
     */
    public function setCacheToken($bearer, $refresh): void
    {
        Cache::put(JwtTypeEnum::BEARER->value, $bearer);
        Cache::put(JwtTypeEnum::REFRESH->value, $refresh);
    }
}
