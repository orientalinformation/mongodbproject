<?php

namespace App\Model;

//use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property string $description
 * @property int $parent_id
 * @property string $path
 */
class Category extends Model
{
//    protected $connection = 'mongodb';
//    protected $collection = 'categories';
//    public $translatedAttributes = [];
    protected $table = 'categories';

    protected $fillable = [
        'name', 'alias', 'description', 'parent_id', 'path'
    ];

    /**
     * get child cat
     * @param $catID
     * @return mixed
     */
    static function getChildCat($catID)
    {
        return Category::where([['parent_id', '=', $catID]])->get();
    }
}
