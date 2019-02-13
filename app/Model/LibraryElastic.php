<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Elasticquent\ElasticquentTrait;

class LibraryElastic extends Model
{
    use ElasticquentTrait;

    protected $indexName = 'library_index';
    protected $table = 'library';
    public $translatedAttributes = [];
    protected $fillable = [
        'name',
        'alias',
        'share',
        'userID',
        'view'
    ];
}
