<?php
namespace App\api\core\users\infrastructure;
use App\api\core\users\infrastructure\UsersController;
use App\Http\Middleware\Cors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::get('/login', [UsersController::class, 'login']);




Route::middleware('auth:sanctum')->group(function () {

    Route::get('/logout', [UsersController::class, 'logout']);
    Route::get('/whoami', [UsersController::class, 'whoami']);
    Route::get('/users', [UsersController::class, 'index']);
    Route::get('/users/{id}', [UsersController::class, 'get'])->where('id', '[0-9]+');
    Route::post('/users', [UsersController::class, 'store']);
    Route::put('/users/{id}', [UsersController::class, 'update'])->where('id', '[0-9]+');
    Route::delete('/users/{id}', [UsersController::class, 'remove'])->where('id', '[0-9]+');
});


