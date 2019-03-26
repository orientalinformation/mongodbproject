<?php
/**
 * Created by PhpStorm.
 * User: binhdq
 * Date: 06/03/2019
 * Time: 10:39
 */

namespace App\Helpers\Envato;
use App\Model\Category;
use App\Repositories\BaseRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryHelper
{
    /**
     * get sub category
     * @param $parentId
     * @return mixed
     */
    public static function getSubCategory($parentId) {
        $result = Category::where([['parent_id', '=', $parentId]])->get()->toArray();
        return $result;
    }
}