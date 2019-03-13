<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model;

class BookDetail extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'book_details';
    public $translatedAttributes = [];
    protected $fillable = [
        'book_id', 'user_id', 'share', 'pink', 'is_public', 'is_delete'
    ];
}
