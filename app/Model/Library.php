<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model;

class Library extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'libraries';
    public $translatedAttributes = [];
    protected $fillable = [
        'name', 'description', 'image', 'alias', 'url', 'view', 'price', 'like', 'category_id', 'is_delete', 'user_id', 'is_public'
    ];
}