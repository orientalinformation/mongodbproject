<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model;

class Library extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'libraries';
    public $translatedAttributes = [];
    protected $fillable = [
        'title', 'alias', 'description', 'image', 'url', 'view', 'price', 'like', 'category_id', 'user_id', 'is_delete'
    ];

    public static function getLibraryByID($id)
    {
        return Library::where([['_id', '=', $id]])->get();
    }
}
