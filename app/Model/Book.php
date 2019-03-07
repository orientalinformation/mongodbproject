<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model;
class Book extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'books';
    public $translatedAttributes = [];
    protected $fillable = [
        'type', 'title', 'alias', 'author', 'description', 'image', 'file', 'price', 'cat_id', 'status', 'share'
    ];

    static function getAllBook(){
        $books = Book::all()->toArray();
        return $books;
    }
}
