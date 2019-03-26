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
use Auth;

class ReadAfterEloquentRepository extends EloquentRepository implements ReadAfterRepositoryInterface
{
    public function getModel()
    {
        return ReadAfter::class;
    }

    /**
     * check read
     * @param $user_id
     * @param $object_id
     * @param $type
     * @return mixed
     */
    public function checkRead($user_id, $object_id, $type)
    {
        return $this->model->where([['user_id', '=', $user_id],
            ['object_id', '=', $object_id],
            ['type_name', '=', $type],
            ['is_delete', '=', 0]])->get();
    }

    /**
     * check unread
     * @param $user_id
     * @param $object_id
     * @param $type
     * @return mixed
     */
    public function checkunRead($user_id, $object_id, $type)
    {
        return $this->model->where([['user_id', '=', $user_id],
            ['object_id', '=', $object_id],
            ['type_name', '=', $type],
            ['is_delete', '=', 1]])->get();
    }

    /**
     * get item readafter with object id
     *
     * @param $objectId
     * @param $type
     * @return mixed
     */
    public function getDataObjectItem($objectId, $type)
    {
        $item = $this->model->where([
            'user_id'   => Auth::user()->id,
            'object_id' => $objectId,
            'type_name' => $type
        ])->first();

        return $item;
    }
}