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
    /**
     * @var CategoryRepositoryInterface|BaseRepositoryInterface
     */
    private static $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        self::$categoryRepository = $categoryRepository;
    }

    /**
     * get sub category
     * @param $parent_id
     * @return mixed
     */
    public static function getSubCategory($parent_id) {
        return self::$categoryRepository->getChildCat($parent_id)->toArray();
    }
}