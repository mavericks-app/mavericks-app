<?php
namespace App\api\agencies\infrastructure;
use App\Enums\Permissions;
use App\Enums\UserRole;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum',"role:".UserRole::SuperAdmin->value] )->group(function () {
        Route::get('/agencies', [AgenciesController::class, 'index']);
        Route::post('/agencies', [AgenciesController::class, 'store']);
        Route::put('/agencies', [AgenciesController::class, 'update']);
        Route::delete('/agencies/{id}', [AgenciesController::class, 'remove']);
});


Route::middleware(['auth:sanctum','permissions:'.Permissions::AgencyGet->value])->group(function () {

    Route::get('/agencies/{id}', [AgenciesController::class, 'get']);

});

