<?php

namespace App\Enums;

/**
 *
 */
enum JwtTypeEnum: string
{
    case BEARER = "bearer";
    case REFRESH = "refresh";
}
