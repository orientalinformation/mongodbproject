<?php
/**
 * Created by PhpStorm.
 * User: binhdq
 * Date: 04/01/2019
 * Time: 11:02
 */

namespace App\Repositories\Category;


interface CategoryRepositoryInterface
{
    public function getChildCat($catID);

    public function paginateOrderByPath($perPage = 15);

    public function allOrderByPath();
}