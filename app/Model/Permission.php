<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $display_name
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property string $key
 * @property PermissionRole $permissionRole
 */
class Permission extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = ['display_name', 'created_at', 'updated_at', 'deleted_at', 'key'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['deleted_at'];
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function permissionRole()
    {
        return $this->hasOne('App\Model\PermissionRole', 'id');
    }
}
