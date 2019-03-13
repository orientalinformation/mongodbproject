<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Rss extends Eloquent
{
    protected $collection = 'rss';
    protected $connection = 'mongodb';
    public $translatedAttributes = [];
    protected $fillable = [
        'id',
        'name',
        'description',
        'url',
        'userId'
    ];

}
