<?php
/**
 * Created by PhpStorm.
 * User: binhdq
 * Date: 20/03/2019
 * Time: 14:24
 */

namespace App\Repositories\WebDetail;


use App\Model\WebDetail;
use App\Repositories\EloquentRepository;

class WebDetailEloquentRepository extends EloquentRepository implements WebDetailRepositoryInterface
{
    /**
     * @return mixed|string
     */
    public function getModel()
    {
        return WebDetail::class;
    }

    public function getAllPublicByUserID($userId, $perPage)
    {
        return WebDetail::where([['user_id', '=', $userId],
            ['is_public', '=', 1],
            ['is_delete', '=', 0]])->paginate($perPage);
    }
}