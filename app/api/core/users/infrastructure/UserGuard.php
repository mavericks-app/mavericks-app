<?php
namespace App\api\core\users\infrastructure;

use App\api\core\users\domain\UserContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class UserGuard implements UserContract {


    public function getUser()
    {
        return Auth::user();
    }

    public function autenticate($credentials){
        return Auth::attempt($credentials);
    }

    public function getToken()
    {
        return $this->getUser()->createToken('JWT')->plainTextToken;
    }

    public function logout()
    {
        $user=Auth::user();
        $user->currentAccessToken()->delete();
        Session::flush();
        return true;
    }

    public function getRoles(): array
    {
        return $this->getUser()->getRoleNames()->toArray();
    }
}
