<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::name("users.")->prefix("users")->controller(UserController::class)->group(function () {
    Route::name("index")->get(null, "index");
    Route::name("store")->post(null, "store");
    Route::name("show")->get("{id}", "show");
    Route::name("update")->put("{id}", "update");
    Route::name("destroy")->delete("{id}", "destroy");
});

Route::name("authentication.")->prefix("authentication")->controller(AuthenticationController::class)->group(function () {
    Route::name("login")->post("login", "login");
    Route::name("show")->get("show", "show");
});
