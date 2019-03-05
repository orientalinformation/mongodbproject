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
        'title', 'alias', 'shortDescription', 'description', 'image', 'price', 'views', 'like', 'catID', 'status', 'share', 'is_public', 'is_delete', 'userId', 'created_at', 'updated_at'
    ];
}
