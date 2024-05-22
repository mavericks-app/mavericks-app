<?php
namespace App\api\core\users\infrastructure;

use App\api\core\shared\contracts\infrastructure\BaseController;
use App\api\core\users\application\Users;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class UsersController extends BaseController
{

    public function login(Request $request, Users $users)
    {


           $request->merge([
               'email' => 'info@mavericks.com',
               'password' => 'mavericks',
           ]);

           $credentials = $request->validate([
               'email' => ['required', 'email'],
               'password' => ['required'],
           ]);

           $success = $users->login($credentials);

           if ($success) {
               return $this->sendResponse($success, 'User login successfully.');
           } else {
               throw new UnauthorizedHttpException("Unauthorized");
           }

    }
}
