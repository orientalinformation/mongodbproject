<?php
/**
 * Created by PhpStorm.
 * User: binhdq
 * Date: 04/01/2019
 * Time: 11:02
 */

namespace App\Repositories\Category;


use App\Model\Category;
use App\Repositories\EloquentRepository;

class CategoryEloquentRepository extends EloquentRepository implements CategoryRepositoryInterface
{
    public function getModel()
    {
        return Category::class;
    }

    public function allByLimit($offset, $limit)
    {
        return $this->model->offset($offset)
            ->limit($limit)
            ->get();
    }

    public function getChildCat($catID)
    {
        return Category::where([['parent_id', '=', $catID]])->get();
    }

    public function paginateOrderByPath($perPage = 15)
    {
        return $this->model->orderBy('path', 'ASC')->paginate($perPage);
    }

    public function allOrderByPath()
    {
        return $this->model->orderBy('path', 'ASC')->get();
    }

    public function parentOrderByPath()
    {
        return Category::where([['parent_id', '=', null]])->orderBy('path', 'ASC')->get();
    }

    /**
     * Get recursive category
     *
     * @param $parent_id
     * @param $level
     * @param $space
     * @param $trees
     * @return mixed
     */
    public function recursiveCategory($parent_id = null, $level = 0, $space = "", $trees = [])
    {
        if (!$trees) {
            $trees = [];
        }
        
        $categories = Category::where('parent_id', $parent_id)->orderBy('path', 'ASC')->get();
        $trees_obj = array();
        if (count($categories) > 0) {
            $level++;
            foreach ($categories as $category) {
                $trees[] = ['id' => $category->_id, 'parent_id' => $category->parent_id, 'name' => $space . $category->name, 'path' => $category->path, 'level' => $level];
                $trees = $this->recursiveCategory($category->_id, $level, $space, $trees);
            }
        }

        if (!empty($trees)) {
            foreach ($trees as $tree) {
                $tree = (object)$tree;
                $trees_obj[] = $tree;
            }
        }

        return $trees_obj;
    }

    /**
     * Get list id category child
     *
     * @param $parent_id
     * @param $trees
     * @return array
     */
    public function getCategoryTreeId($parent_id = null, $trees = [])
    {
        if ($parent_id != null) {
            $trees[] = $parent_id;
        }

        $categories = Category::where('parent_id', $parent_id)->get();
        if (count($categories) > 0) {
            foreach ($categories as $category) {
                $trees[] = $category->_id;
                $trees = $this->getCategoryTreeId($category->_id, $trees);
            }
        }

        $trees = array_unique($trees);
        $trees = array_values($trees);

        return $trees;
    }
}
