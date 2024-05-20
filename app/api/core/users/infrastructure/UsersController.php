<?php
namespace App\api\core\users\infrastructure;

use App\api\core\shared\contracts\infrastructure\CrudController;
use App\api\core\shared\contracts\infrastructure\BaseController;
use App\api\core\users\application\Users;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class UsersController extends BaseController implements CrudController
{

    public function __construct(Users $users)
    {
        $this->users=$users;
    }

    public function login(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

           $success = $this->users->login($credentials);

           if ($success) {
               return $this->sendResponse($success, 'User login successfully.');
           } else {
               throw new UnauthorizedHttpException("Unauthorized");
           }

    }

    public function get(Request $request)
    {

        $users = $this->users->get();

        if ($users) {
            return $this->sendResponse($users, 'Users list');
        }

    }


    public function store(Request $request)
    {

        $data = $request->validate([
            'name'=>['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
            ]);


        $user = $this->users->store($data);

        if ($user) {
            return $this->sendResponse($user, 'User create');
        }

    }

    public function update(Request $request)
    {

        $data = $request->validate([
            'id'=>['required'],
            'name'=>['string'],
            'password'=>['string'],
            'email'=>['string']
        ]);

        $user = $this->users->update($data);

        if ($user) {
            return $this->sendResponse($user, 'User update');
        }

    }

    public function remove(Request $request)
    {
        $data = $request->validate([
            'id'=>['required']
        ]);

        $user = $this->users->remove($request->id);

        if ($user) {
            return $this->sendResponse($user, 'User deleted');
        }

    }
}
