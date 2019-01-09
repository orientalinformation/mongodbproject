<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Elasticquent\ElasticquentTrait;

class PostElastic extends Model
{
    use ElasticquentTrait;

    protected $indexName = 'post_index';
    protected $table = 'post';
    public $translatedAttributes = [];
    protected $fillable = [
        'id',
        'avatar',
        'avatarUrl',
        'scoopName',
        'scoopUrl',
        'authorName',
        'authorUrl',
        'title',
        'titleUrl',
        'postMetaName',
        'postMetaUrl',
        'postMetaDateTime',
        'postMetaDateTimeUrl',
        'description',
        'topicId'
    ];
}
