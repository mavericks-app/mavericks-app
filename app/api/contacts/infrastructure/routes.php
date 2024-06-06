<?php
namespace App\api\contacts\infrastructure;
use App\api\contacts\infrastructure\ContactsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->group(function () {

    Route::get('/contacts', [ContactsController::class, 'index']);
    Route::get('/contacts/{id}', [ContactsController::class, 'get']);
    Route::post('/contacts', [ContactsController::class, 'store']);
    Route::put('/contacts/{id}', [ContactsController::class, 'update']);
    Route::delete('/contacts/{id}', [ContactsController::class, 'remove']);
});


