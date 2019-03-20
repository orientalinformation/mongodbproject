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
    public function getAllPublic($perPage);
}