<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Elasticquent\ElasticquentTrait;

class BookElastic extends Model
{
    use ElasticquentTrait;

    protected $indexName = 'book_index';
    protected $table = 'books';
    public $translatedAttributes = [];
    protected $fillable = [
        'type',
        'title',
        'shortDescription',
        'description',
        'image',
        'price',
        'catID',
        'status'
    ];
}
