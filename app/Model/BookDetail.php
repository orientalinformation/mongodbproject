<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model;

class BookDetail extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'book_details';
    public $translatedAttributes = [];
    protected $fillable = [
        'book_id', 'user_id', 'is_like', 'share', 'pink', 'is_public', 'is_delete'
    ];

    public function book()
	{
	    return $this->belongsTo('App\Model\Book');
	}
}
