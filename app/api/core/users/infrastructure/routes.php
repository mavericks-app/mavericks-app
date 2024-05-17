<?php
namespace App\api\core\users\infrastructure;
use App\Http\Middleware\Cors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/login', [UsersController::class, 'login']);


