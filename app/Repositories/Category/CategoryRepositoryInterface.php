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

    /**
     * Get recursive category
     *
     * @param $parent_id
     * @param $level
     * @param $space
     * @param $trees
     * @return mixed
     */
    public function recursiveCategory($parent_id = null, $level = 0, $space = "", $trees = []);

    /**
     * Get list id category child
     *
     * @param $parent_id
     * @param $trees
     * @return array
     */
    public function getCategoryTreeId($parent_id = null, $trees = []);
}
