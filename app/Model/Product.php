<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model;

class Product extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'products';
    public $translatedAttributes = [];
    protected $fillable = [
        'title', 'alias', 'short_description', 'description', 'image', 'price', 'views', 'like', 'cat_id', 'user_id', 'status', 'share', 'is_public', 'is_delete', 'created_at', 'updated_at'
    ];

    static function getAllProduct(){
        $products = Product::all()->toArray();
        return $products;
    }
}
