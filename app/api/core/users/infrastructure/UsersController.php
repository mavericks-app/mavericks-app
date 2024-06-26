<?php
namespace App\api\core\users\infrastructure;

use App\api\core\shared\contracts\infrastructure\CrudController;
use App\api\core\shared\contracts\infrastructure\BaseController;
use App\api\core\users\application\Users;
use App\Enums\UserRole;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;


class UsersController extends BaseController implements CrudController
{

    protected $users;

    public function __construct(Users $users)
    {
        $this->users=$users;
    }

    /**
     * @unauthenticated
     */
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

    public function logout(Request $request){

        $this->users->logout();
        return $this->sendResponse([], 'User logout successfully.');
    }

    public function whoami(Request $request){
         return $this->sendResponse($this->users->whoami(), 'User whoami');
    }



    public function get(Request $request)
    {

        try{
            $user = $this->users->getId($request->id);

            if ($user) {
                return $this->sendResponse($user, 'User get');
            }

        } catch (ModelNotFoundException $e) {
            return $this->sendError('User not found', 404);
        }

    }

    public function index(Request $request)
    {

        $users = $this->users->paginate();

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
            'agency_id' => ['required', 'integer', 'exists:agencies,id'],
            'roles' => ['nullable', 'array'],
            'roles.*' => ['string','in:'.UserRole::rolesString()] // Asegura que cada elemento en el array de roles sea una cadena de texto
            ]);

        $user = $this->users->store($data);

        if ($user) {
            return $this->sendResponse($user, 'User create');
        }

    }

    public function update(Request $request)
    {

        $data = $request->validate([
            'id' => ['required'],
            'name' => ['nullable', 'string'],
            'password' => ['nullable', 'string']
        ]);

        try {

            $user = $this->users->update($data);

            if ($user) {
                return $this->sendResponse($user, 'User update');
            }
        } catch (ModelNotFoundException $e) {
            return $this->sendError('User not found', 404);
        }

    }

    public function remove(Request $request)
    {
        try {

            $data = $request->validate([
                'id' => ['required']
            ]);

            $user = $this->users->remove($request->id);

            if ($user) {
                return $this->sendResponse($user, 'User deleted');
            }

        }catch (ModelNotFoundException $e){
            return $this->sendError('User not found', 404);
        }

    }


}
