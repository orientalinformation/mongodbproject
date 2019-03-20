<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model;

class BibliothequeDetail extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'bibliotheque_details';
    public $translatedAttributes = [];
    protected $fillable = [
        'id', 'bibliotheque_id', 'user_id', 'share', 'pink', 'is_public', 'is_delete', 'created_at', 'updated_at'
    ];

    public function bibliotheque()
	{
	    return $this->belongsTo('App\Model\Bibliotheque');
	}
}
