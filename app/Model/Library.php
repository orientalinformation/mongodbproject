<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model;

class Library extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'libraries';
    public $translatedAttributes = [];
    protected $fillable = [
        'name', 'bookID', 'status', 'share'
    ];
}
