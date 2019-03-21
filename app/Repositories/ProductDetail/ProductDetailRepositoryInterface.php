<?php

namespace App\Repositories\ProductDetail;


interface ProductDetailRepositoryInterface
{
    /**
     * Get Check Liked
     *
     * @param int $userId
     * @param string $productId
     * @return mixed
     */
    public function checkLiked($userId, $productId);

    /**
     * Get Check unLiked
     *
     * @param int $userId
     * @param string $productId
     * @return mixed
     */
    public function checkunLiked($userId, $productId);

    /**
     * Get Check Shared
     *
     * @param int $userId
     * @param string $productId
     * @return mixed
     */
    public function checkShared($userId, $productId);

    /**
     * Get Check unShared
     *
     * @param int $userId
     * @param string $productId
     * @return mixed
     */
    public function checkunShared($userId, $productId);
}