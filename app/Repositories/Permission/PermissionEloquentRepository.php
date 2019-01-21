<?php
namespace App\Repositories\Permission;

use App\Model\Permission;
use App\Repositories\EloquentRepository;

class PermissionEloquentRepository extends EloquentRepository implements PermissionRepositoryInterface
{
    public function getModel()
    {
        return Permission::class;
    }
}