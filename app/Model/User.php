<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $role_id
 * @property int $company_id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $fullname
 * @property string $birthday
 * @property string $address
 * @property boolean $gender
 * @property string $phone
 * @property string $remember_token
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property boolean $civility
 * @property string $first_name
 * @property string $last_name
 * @property string $postal_code
 * @property string $city
 * @property string $country
 * @property string $sector
 * @property string $interested
 * @property boolean $status
 * @property string $type
 * @property string $society
 * @property string $avatar
 * @property boolean $is_admin
 * @property Role $role
 */
class User extends Authenticatable implements JWTSubject
{
    use Notifiable, SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = ['role_id', 'company_id', 'username', 'password', 'email', 'fullname', 'birthday', 'address', 'gender', 'phone', 'remember_token', 'deleted_at', 'created_at', 'updated_at', 'civility', 'first_name', 'last_name', 'postal_code', 'city', 'country', 'sector', 'interested', 'status', 'type', 'society', 'is_admin', 'avatar'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'deleted_at'];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo('App\Model\Role');
    }
}
