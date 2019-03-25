<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model;

class LibraryDetail extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'library_details';
    public $translatedAttributes = [];
    protected $fillable = [
        'library_id', 'user_id', 'object_id', 'type_name', 'share', 'pink', 'is_public', 'is_delete', 'is_like'
    ];

    public static function getLibraryDetail($library_id, $object_id, $type){
        return LibraryDetail::where([['library_id', '=', $library_id],
            ['user_id', '=', $object_id],
            ['type_name', '=', $type]])->get();
    }
}
