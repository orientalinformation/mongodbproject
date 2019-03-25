<?php

namespace App\Repositories\ProductDetail;


interface ProductDetailRepositoryInterface
{
    

    /**
     * get product detail item
     *
     * @param string $productId
     * @return mixed
     */
    public function getDataItemUser($productId);

    /**
     * get all public by user id
     * @param $userId
     * @param $perPage
     * @return mixed
     */
    public function getAllPublicByUserID($userId, $perPage);
}
