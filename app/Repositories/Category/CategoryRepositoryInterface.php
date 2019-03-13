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
    /**
     * Get child category
     * @param $id
     * @return mixed
     */
    public function getChildCat($catID);

    /**
     * Get category order by path with pagination
     * @param $id
     * @return mixed
     */
    public function paginateOrderByPath($perPage = 15);

    /**
     * Get all category order by path
     * @param $id
     * @return mixed
     */
    public function allOrderByPath();

    /**
     * Get all category parent by path
     * @param $id
     * @return mixed
     */
    public function parentOrderByPath();
}