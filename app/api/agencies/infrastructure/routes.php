<?php
namespace App\api\agencies\infrastructure;
use App\api\agencies\infrastructure\AgenciesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->group(function () {

    Route::get('/agencies', [AgenciesController::class, 'index']);
    Route::get('/agencies/{id}', [AgenciesController::class, 'get']);
    Route::post('/agencies', [AgenciesController::class, 'store']);
    Route::put('/agencies', [AgenciesController::class, 'update']);
    Route::delete('/agencies/{id}', [AgenciesController::class, 'remove']);
});


