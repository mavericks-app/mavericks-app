<?php
namespace App\api\core\users\infrastructure;

use App\api\core\users\domain\UserContract;
use App\Enums\UserRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
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
        $user=$this->getUser();
        $user->currentAccessToken()->delete();
        Session::flush();
        return true;
    }

    public function getRoles($idUser=""): array
    {
        if($idUser>0){
            $user=$this->getUser()->findOrFail($idUser);
            return $user->getRoleNames()->toArray();
        }else {
            return $this->getUser()->getRoleNames()->toArray();
        }
    }

    public function hasRole(Array $roles):bool
    {
        return $this->getUser()->hasAnyRole($roles);
    }

    public function assignRoleUser($id,Array $roles)
    {
        $user=$this->getUser()->findOrFail($id);

            $roleClientArr = Role::whereIn('name', $roles)->get();

            if($roleClientArr->isNotEmpty()){
                foreach($roleClientArr as $role) {
                    $user->assignRole($role);
                }
            }

    }

    public function getPermissions(){

        $permissions=$this->getUser()->getAllPermissions()->pluck('name')->toArray();
        return $permissions;

    }

    public function can(array $permissions):bool{

        $user = $this->getUser();

        if ($user) {
            foreach ($permissions as $permission) {
                if ($user->can($permission)) {
                    return true;
                }
            }
        }

        return false;

    }
}
