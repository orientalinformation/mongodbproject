<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Elasticquent\ElasticquentTrait;

class CategoryElastic extends Model
{
    use ElasticquentTrait;

    protected $indexName = 'category_index';
    protected $table = 'category';
    public $translatedAttributes = [];
    protected $fillable = [
        'name',
        'description',
        'parentID'
    ];
}
