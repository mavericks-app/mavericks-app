<?php
namespace App\api\core\users\infrastructure;

use App\api\core\users\domain\User;
use App\api\core\users\domain\UserContract;
use App\Enums\UserRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class UserGuard implements UserContract {



    public function getModel()
    {
        return Auth::user();
    }

    public function getUser()
    {
        $domain= User::create($this->getModel()->toArray());
        $domain->setRoles($this->getRoles());
        $domain->setPermissions($this->getPermissions());
        return $domain;
    }


    public function autenticate($credentials){
        return Auth::attempt($credentials);
    }

    public function getToken()
    {
        return $this->getModel()->createToken('JWT')->plainTextToken;
    }

    public function logout()
    {
        $user=$this->getModel();
        $user->currentAccessToken()->delete();
        Session::flush();
        return true;
    }

    public function getRoles($idUser=""): array
    {
        if($idUser>0){
            $user=$this->getModel()->findOrFail($idUser);
            return $user->getRoleNames()->toArray();
        }else {
            return $this->getModel()->getRoleNames()->toArray();
        }
    }

    public function hasRole(Array $roles):bool
    {
        return $this->getModel()->hasAnyRole($roles);
    }

    public function assignRoleUser($id,Array $roles)
    {
            $user=$this->getModel()->findOrFail($id);

            $roleClientArr = $user->getRoleNames()->toArray();

            if(count($roleClientArr)>0){

                $rolesToRemove = array_diff($roleClientArr , $roles);
                $rolesToAdd = array_diff($roles, $roleClientArr );

                foreach ($rolesToRemove as $roleName) {
                        $user->removeRole($roleName);
                }

                foreach ($rolesToAdd as $role){
                    $user->assignRole($role);
                }
            }

    }

    public function getPermissions(){

        $permissions=$this->getModel()->getAllPermissions()->pluck('name')->toArray();
        return $permissions;

    }

    public function can(array $permissions):bool{

        $user = $this->getModel();

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
