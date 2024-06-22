<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::name('api.')->group(function () {
    // Auth
    Route::controller(AuthController::class)
        ->group(function () {
            Route::post('/login/do', 'attempt')->name('login.do')->withoutMiddleware('auth-api');
            Route::get('/logout', 'logout')->name('logout')->middleware('auth:sanctum');
        });
    });

    // Rota default laravel API, teste de middleware de autenticação
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
