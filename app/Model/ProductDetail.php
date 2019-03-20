<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model;

class ProductDetail extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'product_details';
    public $translatedAttributes = [];
    protected $fillable = [
        'id', 'product_id', 'user_id', 'share', 'pink', 'is_public', 'is_delete', 'created_at', 'updated_at'
    ];

    public function product()
	{
	    return $this->belongsTo('App\Model\Product');
	}
}
