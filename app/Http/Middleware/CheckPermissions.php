<?php

namespace App\Http\Middleware;

use App\api\core\users\application\Users;
use App\api\core\users\domain\UserContract;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermissions
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

    public function handle(Request $request, Closure $next,...$permissions): Response
    {

        if ($this->userService->can($permissions)) {
            return $next($request);
        }

        // Redirigir o devolver una respuesta de error según sea necesario
        return response()->json(['error' => 'Unauthorized'], 401);

    }
}
