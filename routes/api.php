<?php

use App\api\core\users\infrastructure\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;


// Obtener la lista de todos los archivos PHP en la carpeta "api"
$routeFiles =collect(File::allFiles(app_path('api')))->filter(function ($file) {
        // Filtrar solo los archivos que tengan el nombre "routes.php"
        return $file->getFilename() === 'routes.php';
    });


// Agrupar las rutas dentro de un grupo con middleware
Route::prefix("v1")->group(function () use ($routeFiles) {
    foreach ($routeFiles as $routeFile) {
            // Cargar la ruta de API
            include_once $routeFile->getPathname();
    }
});


