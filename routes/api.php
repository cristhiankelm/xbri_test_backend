<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
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

Route::controller(ClientController::class)
->group(function () {
    Route::get('/clientes', 'index')->name('clients.index');
    Route::get('/cliente/{id}', 'show')->name('clients.show');
    Route::post('/cliente', 'store')->name('clients.store');
    Route::put('/cliente/{id}', 'update')->name('clients.update');
    Route::delete('/cliente/{id}', 'destroy')->name('clients.destroy');
});

// Rota default laravel API, teste de middleware de autenticação
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
