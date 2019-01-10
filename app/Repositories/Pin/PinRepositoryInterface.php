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
    public function findByMultiWhere($itemID, $userID, $type);
}