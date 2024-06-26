<?php

namespace App\Http\Middleware;

use App\api\core\users\application\Users;
use App\api\core\users\domain\UserContract;
use App\api\core\users\infrastructure\UserGuard;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */


    private UserContract $userService;

    public function __construct(Users $users){
        $this->userService=$users->getUserService();
    }

    public function handle(Request $request, Closure $next,...$roles): Response
    {
        // Obtener el usuario autenticado

        // Verificar si el usuario está autenticado y tiene al menos uno de los roles proporcionados
        if ($this->userService && $this->userService->hasRole($roles)) {
            return $next($request);
        }

        // Redirigir o devolver una respuesta de error según sea necesario
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
