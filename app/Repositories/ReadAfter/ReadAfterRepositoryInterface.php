<?php
/**
 * Created by PhpStorm.
 * User: binhdq
 * Date: 14/03/2019
 * Time: 16:59
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
}