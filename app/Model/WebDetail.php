<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model;

class WebDetail extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'web_details';
    public $translatedAttributes = [];
    protected $fillable = [
        'web_id', 'user_id', 'share', 'pink', 'is_public', 'is_delete'
    ];
}