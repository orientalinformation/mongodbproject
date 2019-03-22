<?php
/**
 * Created by PhpStorm.
 * User: binhdq
<<<<<<< HEAD
 * Date: 15/03/2019
 * Time: 14:01
=======
 * Date: 14/03/2019
 * Time: 16:59
>>>>>>> binh
 */

namespace App\Repositories\ReadAfter;


interface ReadAfterRepositoryInterface
{
    /**
     * Get Check Read
     * @return mixed
     */
    public function checkRead($user_id, $object_id, $type);

    /**
     * Get Check unRead
     * @return mixed
     */
    public function checkunRead($user_id, $object_id, $type);

    /**
     * get item readafter with object id
     *
     * @param $objectId
     * @param $type
     * @return mixed
     */
    public function getDataObjectItem($objectId, $type);
}