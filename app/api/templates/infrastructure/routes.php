<?php
namespace App\api\templates\infrastructure;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->group(function () {

    Route::get('/templates', [TemplatesController::class, 'index']);
    Route::get('/templates/{id}', [TemplatesController::class, 'get']);
    Route::post('/templates', [TemplatesController::class, 'store']);
    Route::put('/templates', [TemplatesController::class, 'update']);
    Route::delete('/templates/{id}', [TemplatesController::class, 'remove']);
});


