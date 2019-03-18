<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model;

class Library extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'libraries';
    public $translatedAttributes = [];
    protected $fillable = [
        'name', 'alias', 'share', 'user_id', 'view', 'is_delete'
    ];
}