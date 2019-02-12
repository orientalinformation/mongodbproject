<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Elasticquent\ElasticquentTrait;

class DiscussionElastic extends Model
{
    use ElasticquentTrait;

    protected $indexName = 'discussion_index';
    protected $table = 'discussion';
    public $translatedAttributes = [];
    protected $fillable = [
        'title',
        'type',
        'moderator',
        'start',
        'end'
    ];
}
