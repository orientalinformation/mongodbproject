<?php
/**
 * Created by PhpStorm.
 * User: binhdq
 * Date: 08/01/2019
 * Time: 08:59
 */

namespace App\Repositories\Pin;


interface PinRepositoryInterface
{
    /**
     * find by multi where
     * @param $itemID
     * @param $userID
     * @param $type
     * @return mixed
     */
    public function findByMultiWhere($itemID, $userID, $type);
}