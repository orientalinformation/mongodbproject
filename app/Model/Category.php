<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model;

class Category extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'categories';
    public $translatedAttributes = [];
    protected $fillable = [
        'name', 'description', 'parent_id', 'path'
    ];

    static function getChildCat($catID)
    {
        return Category::where([['parent_id', '=', $catID]])->get();
    }
}
