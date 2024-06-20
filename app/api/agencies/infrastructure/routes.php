<?php
namespace App\api\agencies\infrastructure;
use App\Enums\UserRole;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum',"role:".UserRole::SuperAdmin->value] )->group(function () {

            Route::get('/agencies', [AgenciesController::class, 'index']);
            Route::get('/agencies/{id}', [AgenciesController::class, 'get']);
            Route::post('/agencies', [AgenciesController::class, 'store']);
            Route::put('/agencies', [AgenciesController::class, 'update']);
            Route::delete('/agencies/{id}', [AgenciesController::class, 'remove']);

});


