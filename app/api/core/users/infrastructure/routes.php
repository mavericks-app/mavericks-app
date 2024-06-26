<?php
namespace App\api\core\users\infrastructure;
use Illuminate\Support\Facades\Route;


Route::get('/login', [UsersController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {

    Route::get('/logout', [UsersController::class, 'logout']);
    Route::get('/whoami', [UsersController::class, 'whoami']);
    Route::get('/users', [UsersController::class, 'index']);
    Route::get('/users/{id}', [UsersController::class, 'get'])->where('id', '[0-9]+');
    Route::post('/users', [UsersController::class, 'store']);
    Route::put('/users', [UsersController::class, 'update']);
    Route::delete('/users/{id}', [UsersController::class, 'remove'])->where('id', '[0-9]+');
});


