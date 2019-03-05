<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model;

class Product extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'products';
    public $translatedAttributes = [];
    protected $fillable = [
        'title', 'alias', 'shortDescription', 'description', 'image', 'price', 'views', 'like', 'catID', 'status', 'share', 'is_public', 'is_delete', 'userId', 'created_at', 'updated_at'
    ];

    static function getAllProduct(){
        $products = Product::all()->toArray();
        return $products;
    }
}
