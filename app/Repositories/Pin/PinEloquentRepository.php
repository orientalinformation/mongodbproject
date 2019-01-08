<?php
/**
 * Created by PhpStorm.
 * User: binhdq
 * Date: 07/01/2019
 * Time: 17:06
 */

namespace App\Repositories\Pin;


use App\Model\Pin;
use App\Repositories\EloquentRepository;
use App\Repositories\Pin\PinRepositoryInterface;

class PinEloquentRepository extends EloquentRepository implements PinRepositoryInterface
{
    public function getModel()
    {
        return Pin::class;
    }

    /**
     * find Pin by multiple condition
     */
    public function findByMultiWhere($itemID, $userID, $type)
    {
        return Pin::where([['itemID', '=', $itemID],
                            ['userID', '=', (int)$userID],
                            ['type', '=', $type]])->get();
    }
}