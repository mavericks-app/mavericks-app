<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'welcome';
});



Route::get('/prueba', function () {
    return 'welcome prueba';
});
