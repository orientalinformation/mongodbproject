<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model;

class Bibliotheque extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'bibliotheques';
    public $translatedAttributes = [];
    protected $fillable = [
        'id',
        'title',
        'description',
        'image',
        'url',
        'view',
        'price',
        'like',
        'category_id',
        'is_delete',
        'created_at',
        'updated_at'
    ];

    static function getAllProduct()
    {
        $products = [];
        return $products;
    }
}
