<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model;
class Book extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'books';
    public $translatedAttributes = [];
    protected $fillable = [
        'type', 'title', 'alias', 'author', 'description', 'image', 'file', 'price', 'cat_id', 'status', 'share', 'view'
    ];

    public static function getAllBook(){
        return Book::all()->toArray();
    }

    public static function getBookByID($id)
    {
        return Book::where([['_id', '=', $id]])->get();
    }
}
