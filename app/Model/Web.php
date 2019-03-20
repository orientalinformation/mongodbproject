<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Web extends Eloquent
{
    protected $collection = 'web';
    protected $connection = 'mongodb';
    public $translatedAttributes = [];
    protected $fillable = [
        'id',
        'title',
        'link',
        'enclosure',
        'description',
        'pub_date'
    ];

    public static function getWebByID($id)
    {
        return Web::where([['_id', '=', $id]])->get();
    }
}
