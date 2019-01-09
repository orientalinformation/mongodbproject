<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model;
class Book extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'books';
    public $translatedAttributes = [];
    protected $fillable = [
        'title', 'description', 'image'
    ];

    static function getAllBook(){
        $books = Book::all()->toArray();
        return $books;
    }
}
