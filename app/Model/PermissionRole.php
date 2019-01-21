<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $permission_id
 * @property int $role_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Role $role
 * @property Permission $permission
 */
class PermissionRole extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['permission_id', 'role_id', 'created_at', 'updated_at', 'deleted_at'];

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
