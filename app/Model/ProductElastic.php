<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Elasticquent\ElasticquentTrait;

class ProductElastic extends Model
{
    use ElasticquentTrait;

    protected $indexName = 'product_index';
    protected $table = 'product';
    public $translatedAttributes = [];
    protected $fillable = [
        'title', 'description', 'image', 'url', 'view', 'like', 'category_id', 'is_delete', 'created_at', 'updated_at'
    ];
}
