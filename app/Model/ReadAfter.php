<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model;

class ReadAfter extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'read_afters';
    public $translatedAttributes = [];
    protected $fillable = [
        'object_id', 'user_id', 'type_name', 'is_delete'
    ];
}
