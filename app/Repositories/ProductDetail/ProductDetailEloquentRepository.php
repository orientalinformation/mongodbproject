<?php
/**
 * Created by PhpStorm.
 * User: binhdq
 * Date: 20/03/2019
 * Time: 18:20
 */

namespace App\Repositories\ProductDetail;


use App\Model\ProductDetail;
use App\Repositories\EloquentRepository;

class ProductDetailEloquentRepository extends EloquentRepository implements ProductDetailRepositoryInterface
{
    /**
     * @return mixed|string
     */
    public function getModel()
    {
        return ProductDetail::class;
    }

    public function getAllPublic($perPage)
    {
        return ProductDetail::where([['is_public', '=', 1],
            ['is_delete', '=', 0]])->paginate($perPage);
    }
}