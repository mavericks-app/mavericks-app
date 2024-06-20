<?php

namespace App\Http\Middleware;

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
    public function handle(Request $request, Closure $next,...$roles): Response
    {
        // Obtener el usuario autenticado


        $user = Auth::user();

        // Verificar si el usuario está autenticado y tiene al menos uno de los roles proporcionados
        if ($user && $user->hasAnyRole($roles)) {
            return $next($request);
        }

        // Redirigir o devolver una respuesta de error según sea necesario
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
