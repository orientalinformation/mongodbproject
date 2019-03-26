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
    /**
     * @var ProductRepositoryInterface|BaseRepositoryInterface
     */
    private static $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        self::$productRepository = $productRepository;
    }

    /**
     * get product detail
     * @param $id
     * @return mixed
     */
    public static function getProductDetail($id) {
        $result = self::$productRepository->getProductByID($id)->toArray();
        return $result;
    }
}