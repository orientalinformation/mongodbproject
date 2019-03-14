<?php
/**
 * Created by PhpStorm.
 * User: binhdq
 * Date: 14/03/2019
 * Time: 16:56
 */

namespace App\Repositories\ReadAfter;


use App\Model\ReadAfter;
use App\Repositories\EloquentRepository;

class ReadAfterEloquentRepository extends EloquentRepository implements ReadAfterRepositoryInterface
{
    public function getModel()
    {
        return ReadAfter::class;
    }

    public function checkRead($user_id, $object_id, $type)
    {
        return ReadAfter::where([['user_id', '=', $user_id],
            ['object_id', '=', $object_id],
            ['type_name', '=', $type],
            ['is_delete', '=', 0]])->get();
    }

    public function checkunRead($user_id, $object_id, $type)
    {
        return BookDetail::where([['user_id', '=', $user_id],
            ['object_id', '=', $object_id],
            ['type_name', '=', $type],
            ['is_delete', '=', 1]])->get();
    }
}