<?php

namespace App\Model;


use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Topic extends Eloquent
{
    protected $collection = 'topic';
    protected $connection = 'mongodb';
    public $translatedAttributes = [];
    protected $fillable = [
        'id',
        'name'
    ];
}
