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
}
