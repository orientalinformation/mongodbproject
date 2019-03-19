<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model;

class Research extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'researches';
    public $translatedAttributes = [];
    protected $fillable = [
        'name', 'keyword', 'user_id', 'is_delete', 'created_at', 'updated_at'
    ];

    static function getAllResearches(){
        $products = Research::all()->toArray();
        return $products;
    }
}
