<?php
/**
 * Created by PhpStorm.
 * User: trieunb
 * Date: 04/01/2019
 * Time: 09:44
 */

namespace App\Repositories\Post;


use App\Model\Post;
use App\Repositories\EloquentRepository;

class PostEloquentRepository extends EloquentRepository implements PostRepositoryInterface
{
    public function getModel()
    {
        return Post::class;
    }

}