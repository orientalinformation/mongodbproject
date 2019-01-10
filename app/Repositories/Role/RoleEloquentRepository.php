<?php
namespace App\Repositories\Role;

use App\Model\Role;
use App\Repositories\EloquentRepository;

class RoleEloquentRepository extends EloquentRepository implements RoleRepositoryInterface
{
    public function getModel()
    {
        return Role::class;
    }

}