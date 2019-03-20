<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model;

class Product extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'products';
    public $translatedAttributes = [];
    protected $fillable = [
        'title', 'description', 'image', 'url', 'view', 'like', 'category_id', 'is_delete', 'created_at', 'updated_at'
    ];

    static function getAllProduct(){
        $products = Product::all()->toArray();
        return $products;
    }

    public static function getProductByID($id)
    {
        return Product::where([['_id', '=', $id]])->get();
    }
}
