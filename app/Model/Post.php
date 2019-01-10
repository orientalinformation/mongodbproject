<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Post extends Eloquent
{

    protected $collection = 'post';
    protected $connection = 'mongodb';
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
