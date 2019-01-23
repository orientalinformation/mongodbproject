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
        return Category::where([['parentID', '=', $catID]])->get();
    }
}