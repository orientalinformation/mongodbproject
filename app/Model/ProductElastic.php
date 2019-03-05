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
        'title', 'alias', 'short_description', 'description', 'image', 'price', 'views', 'like', 'cat_id', 'user_id', 'status', 'share', 'is_public', 'is_delete', 'created_at', 'updated_at'
    ];
}
