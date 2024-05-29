<?php
namespace App\api\models\infrastructure;
use App\api\models\infrastructure\ModelsController;
use App\Http\Middleware\Cors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->group(function () {

    Route::get('/models', [ModelsController::class, 'index']);
    Route::get('/models/{id}', [ModelsController::class, 'get']);
    Route::post('/models', [ModelsController::class, 'store']);
    Route::put('/models/{id}', [ModelsController::class, 'update']);
    Route::delete('/models/{id}', [ModelsController::class, 'remove']);
});


