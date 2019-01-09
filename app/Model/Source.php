<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Source extends Eloquent
{
    protected $collection = 'source';
    protected $connection = 'mongodb';
    public $translatedAttributes = [];
    protected $fillable = [
        'id',
        'name',
        'description',
        'url',
        'type'
    ];


    /**
     * Get only technology
     * @param $query
     * @return mixed
     */
    public function scopeTechnology($query)
    {
        return $query->where('type', 0);
    }

    /**
     * Get only law document
     * @param $query
     * @return mixed
     */
    public function scopeDocument($query)
    {
        return $query->where('type', 1);
    }
}
