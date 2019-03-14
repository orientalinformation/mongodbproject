<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model;

class Bibliotheque extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'bibliotheques';
    public $translatedAttributes = [];
    protected $fillable = [

    ];

    static function getAllProduct()
    {
        $products = [];
        return $products;
    }
}
