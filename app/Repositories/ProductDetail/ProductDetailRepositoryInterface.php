<?php
/**
 * Created by PhpStorm.
 * User: binhdq
 * Date: 20/03/2019
 * Time: 18:27
 */

namespace App\Repositories\ProductDetail;


interface ProductDetailRepositoryInterface
{
    /**
     * Get Check Liked
     *
     * @param int $user_id
     * @param string $product_id
     * @return mixed
     */
    public function checkLiked($user_id, $product_id);

    /**
     * Get Check unLiked
     *
     * @param int $user_id
     * @param string $product_id
     * @return mixed
     */
    public function checkunLiked($user_id, $product_id);

    /**
     * Get Check Shared
     *
     * @param int $user_id
     * @param string $product_id
     * @return mixed
     */
    public function checkShared($user_id, $product_id);

    /**
     * Get Check unShared
     *
     * @param int $user_id
     * @param string $product_id
     * @return mixed
     */
    public function checkunShared($user_id, $product_id);

    public function getAllPublicByUserID($userId, $perPage);
}