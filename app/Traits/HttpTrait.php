<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;
use Throwable;

/**
 *
 */
trait HttpTrait
{
    /**
     * @param $url
     * @param $method
     * @return string
     * @throws Throwable
     */
    public function request($url, $method): mixed
    {
        $response = Http::withHeaders([
            'bearrer' => request()->input("bearrer"),
            'refresh' => request()->input("refresh")
        ])->$method($url);
        throw_if($response->failed(), \Exception::class, $url);

        request()->merge([
            'bearrer' => $response->header("bearrer"),
            'refresh' => $response->header("refresh")
        ]);
        return $response->collect();
    }
}
