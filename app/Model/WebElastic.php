<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Elasticquent\ElasticquentTrait;

class WebElastic extends Model
{
    use ElasticquentTrait;

    protected $table = 'web';
    public $translatedAttributes = [];
    protected $fillable = [
        'id',
        'title',
        'url',
        'image',
        'description',
        'pubDate',
        'status',
    ];
}
