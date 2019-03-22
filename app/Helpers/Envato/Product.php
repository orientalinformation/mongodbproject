<?php
/**
 * Created by PhpStorm.
 * User: binhdq
 * Date: 20/03/2019
 * Time: 18:27
 */

namespace App\Helpers\Envato;
use App\Model\Product;

class ProductHelper
{
    public static function getProductDetail($id) {
        $result = Product::getProductByID($id)->toArray();
        return $result;
    }
}