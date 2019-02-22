<?php
namespace App\Repositories\Role;

use App\Model\Role;
use App\Model\Permission;
use App\Model\PermissionRole;
use App\Repositories\EloquentRepository;
use Auth;

class RoleEloquentRepository extends EloquentRepository implements RoleRepositoryInterface
{
    public function getModel()
    {
        return Role::class;
    }

    /**
     * has Role
     *
     * @param [type] $name
     * @return boolean
     */
    public function hasRole($name)
    {
        $roleName = Auth::user()->role->name;
        
        if ($roleName == $name) {
            return true;
        }
        return false;
    }

    /**
     * has Permission
     *
     * @param [type] $key
     * @return boolean
     */
    public function hasPermission($key)
    {   
        $roleId = Auth::user()->role_id;

        // get permission by key
        $permission = Permission::where('key', $key)->first();

        if ($permission) {
            
            return PermissionRole::where('role_id', $roleId)
                    ->where('permission_id', $permission->id)
                    ->exists();
        }
        return false;
    }

    /**
     * Get Role By Key
     *
     * @param [type] $key
     * @param [type] $value
     * @return void
     */
    public function getRoleByKey($key, $value)
    {
        return Role::where($key, $value)->first();
    }
}