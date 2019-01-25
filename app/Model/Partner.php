<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $web
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 */
class Partner extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'address', 'web', 'deleted_at', 'created_at', 'updated_at'];

}
