<?php
/**
 * Created by PhpStorm.
 * User: trieunb
 * Date: 04/01/2019
 * Time: 11:37
 */

namespace App\Repositories\Topic;


use App\Model\Topic;
use App\Repositories\EloquentRepository;

class TopicEloquentRepository extends EloquentRepository implements TopicRepositoryInterface
{
    public function getModel()
    {
        return Topic::class;
    }
}