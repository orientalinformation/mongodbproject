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

    public function checkLiked($user_id, $product_id)
    {
        return ProductDetail::where([['user_id', '=', $user_id],
            ['product_id', '=', $product_id],
            ['is_delete', '=', 0]])->get();
    }

    public function checkunLiked($user_id, $product_id)
    {
        return ProductDetail::where([['user_id', '=', $user_id],
            ['product_id', '=', $product_id],
            ['is_delete', '=', 1]])->get();
    }

    public function checkShared($user_id, $product_id)
    {
        return ProductDetail::where([['user_id', '=', $user_id],
            ['product_id', '=', $product_id],
            ['share', '=', 1],
            ['is_delete', '=', 0]])->get();
    }

    public function checkunShared($user_id, $product_id)
    {
        return ProductDetail::where([['user_id', '=', $user_id],
            ['product_id', '=', $product_id],
            ['share', '=', 0],
            ['is_delete', '=', 0]])->get();
    }
}