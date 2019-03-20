<?php
/**
 * Created by PhpStorm.
 * User: binhdq
 * Date: 20/03/2019
 * Time: 15:06
 */

namespace App\Helpers\Envato;
use App\Model\Web;
use App\Model\Product;

class WebHelper
{
    public static function getWebDetail($id) {
        $result = Web::getWebByID($id)->toArray();
        return $result;
    }

    public static function getProductDetail($id) {
        $result = Product::getProductByID($id)->toArray();
        return $result;
    }
}