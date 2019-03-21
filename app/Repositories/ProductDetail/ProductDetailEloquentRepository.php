<?php
/**
 * Created by PhpStorm.
 * User: binhdq
 * Date: 20/03/2019
 * Time: 18:20
 */

namespace App\Repositories\ProductDetail;

use App\Model\ProductDetail;
use App\Repositories\EloquentRepository;

class ProductDetailEloquentRepository extends EloquentRepository implements ProductDetailRepositoryInterface
{
    /**
     * @return mixed|string
     */
    public function getModel()
    {
        return ProductDetail::class;
    }

    /**
     * Get Check Liked
     *
     * @param int $userId
     * @param string $productId
     * @return mixed
     */
    public function checkLiked($userId, $productId)
    {
        return ProductDetail::where([['user_id', '=', $userId],
            ['product_id', '=', $productId],
            ['is_delete', '=', 0]])->get();
    }

    /**
     * Get Check unLiked
     *
     * @param int $userId
     * @param string $productId
     * @return mixed
     */
    public function checkunLiked($userId, $productId)
    {
        return ProductDetail::where([['user_id', '=', $userId],
            ['product_id', '=', $productId],
            ['is_delete', '=', 1]])->get();
    }

    /**
     * Get Check Shared
     *
     * @param int $userId
     * @param string $productId
     * @return mixed
     */
    public function checkShared($userId, $productId)
    {
        return ProductDetail::where([['user_id', '=', $userId],
            ['product_id', '=', $productId],
            ['share', '=', 1],
            ['is_delete', '=', 0]])->get();
    }

    /**
     * Get Check unShared
     *
     * @param int $userId
     * @param string $productId
     * @return mixed
     */
    public function checkunShared($userId, $productId)
    {
        return ProductDetail::where([['user_id', '=', $userId],
            ['product_id', '=', $productId],
            ['share', '=', 0],
            ['is_delete', '=', 0]])->get();
    }

    public function getAllPublicByUserID($userId, $perPage)
    {
        return ProductDetail::where([['user_id', '=', $userId],
            ['is_public', '=', 1],
            ['is_delete', '=', 0]])->paginate($perPage);
    }
}