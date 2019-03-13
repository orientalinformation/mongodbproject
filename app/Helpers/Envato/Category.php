<?php
/**
 * Created by PhpStorm.
 * User: binhdq
 * Date: 06/03/2019
 * Time: 10:39
 */

namespace App\Helpers\Envato;
use App\Model\Category;

class CategoryHelper
{
    public static function getSubCategory($parent_id) {
        return Category::getChildCat($parent_id)->toArray();
    }
}