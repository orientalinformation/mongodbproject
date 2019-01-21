<?php
namespace App\Repositories\PermissionRole;

use App\Model\PermissionRole;
use App\Model\Permission;
use App\Repositories\EloquentRepository;

class PermissionRoleEloquentRepository extends EloquentRepository implements PermissionRoleRepositoryInterface
{
    public function getModel()
    {
        return PermissionRole::class;
    }

    /**
     * get all permission assign by role id
     *
     * @param [type] $roleId
     * @return void
     */
    public function getPermissionsByRoleId($roleId)
    {
        $permsArr = [];
        $actives = [];
        $permissions = Permission::orderBy('key', 'DESC')->with('permissionRoles')->get();
        $permissionRoles = PermissionRole::where('role_id', $roleId)->get();  
        
        // get permission of role
        if (count($permissionRoles) > 0) {

            foreach ($permissionRoles as $permission) {
                array_push($actives, $permission->permission_id);
            }
        }    

        // get all permission
        if (count($permissions) > 0) {

            foreach ($permissions as $permission) {
                $permsTemp = [];
                $permsTemp['id'] = $permission->id;
                $permsTemp['display_name'] = $permission->display_name;
                $permsTemp['key'] = $permission->key;
                $permsTemp['active'] = '';

                if (count($actives) > 0) {

                    if (in_array($permission->id, $actives)) {
                        $permsTemp['active'] = 'checked';
                    } 
                }
                
                array_push($permsArr, $permsTemp);
            }
        }
        
        return $permsArr;
    }

    public function assignPermissionForRole(array $permissions, $roleId)
    {
        if (count($permissions) > 0) {
            
            // delete role before update permisstion
            PermissionRole::where('role_id', $roleId)->delete();

            // update
            foreach ($permissions as $permission) {

                $data = array(
                    'permission_id'  => $permission,
                    'role_id' => $roleId
                );

                $this->model->create($data);
            }
        }

        return true;
    }

}