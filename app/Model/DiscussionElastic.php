<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DiscussionElastic extends Model
{
    use ElasticquentTrait;

    protected $indexName = 'discussion_index';
    protected $table = 'discussion';
    public $translatedAttributes = [];
    protected $fillable = [
        'name',
        'type',
        'moderator',
        'start',
        'end'
    ];
}
