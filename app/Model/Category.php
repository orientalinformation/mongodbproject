<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model;
//use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property string $description
 * @property int $parent_id
 * @property string $path
 */
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
