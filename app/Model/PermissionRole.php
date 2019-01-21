<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $role_id
 * @property int $permission_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Role $role
 * @property Permission $permission
 */
class PermissionRole extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = ['role_id', 'permission_id', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['deleted_at'];
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo('App\Model\Role');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function permission()
    {
        return $this->belongsTo('App\Model\Permission');
    }
}
