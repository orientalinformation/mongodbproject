<?php

namespace App\Repositories\ProductDetail;

use App\Model\ProductDetail;
use App\Repositories\EloquentRepository;

class ProductDetailEloquentRepository extends EloquentRepository implements ProductDetailRepositoryInterface
{
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
}