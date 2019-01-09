<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Elasticquent\ElasticquentTrait;

class BookElastic extends Model
{
    use ElasticquentTrait;

    protected $table = 'books';
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
    protected $mappingProperties = array(
        'type' => array(
            'type' => 'string',
            'analyzer' => 'standard',
        ),
        'title' => array(
            'type' => 'string',
            'analyzer' => 'standard',
        ),
        'shortDescription' => array(
            'type' => 'string',
            'analyzer' => 'standard',
        ),
        'description' => array(
            'type' => 'string',
            'analyzer' => 'standard',
        ),
        'image' => array(
            'type' => 'string',
            'analyzer' => 'standard',
        ),
        'price' => array(
            'type' => 'int',
            'analyzer' => 'standard',
        ),
        'catID' => array(
            'type' => 'string',
            'analyzer' => 'standard',
        ),
        'status' => array(
            'type' => 'int',
            'analyzer' => 'standard',
        ),
    );
}
