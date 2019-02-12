<?php
/**
 * Created by PhpStorm.
 * User: binhdq
 * Date: 25/01/2019
 * Time: 15:04
 */

namespace App\Repositories\Discussion;


use App\Model\Discussion;
use App\Repositories\EloquentRepository;

class DiscussionEloquentRepository extends EloquentRepository implements DiscussionRepositoryInterface
{

    /**
     * Get model
     * @return mixed
     */
    public function getModel()
    {
        return Discussion::class;
    }
}