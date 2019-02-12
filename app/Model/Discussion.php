<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model;

class Discussion extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'discussions';
    public $translatedAttributes = [];
    protected $fillable = [
        'title', 'type', 'moderator', 'start', 'end'
    ];
}
