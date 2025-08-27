<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::any('/logout', LogoutController::class);
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });
});

Route::post('/login', LoginController::class)->name('api.login');
