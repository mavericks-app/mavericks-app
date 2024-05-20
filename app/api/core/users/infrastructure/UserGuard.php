<?php
namespace App\api\core\users\infrastructure;

use App\api\core\users\domain\UserContract;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class UserGuard implements UserContract {

    protected $auth=null;

    public function __construct()
    {
        $this->auth=Auth::guard();
    }

    public function getUser()
    {
        return $this->auth->user();
    }

    public function autenticate($credentials){
        return Auth::attempt($credentials);
    }

    public function getToken()
    {
        return $this->getUser()->createToken('JWT')->plainTextToken;
    }

}
