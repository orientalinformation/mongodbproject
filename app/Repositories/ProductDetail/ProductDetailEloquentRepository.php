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
use Auth;

class ProductDetailEloquentRepository extends EloquentRepository implements ProductDetailRepositoryInterface
{
    /**
     * @return mixed|string
     */
    public function getModel()
    {
        return ProductDetail::class;
    }

    /**
     * get product detail item
     *
     * @param string $productId
     * @return mixed
     */
    public function getDataItemUser($productId)
    {
        $item = $this->model->where([
            'user_id'    => Auth::user()->id,
            'product_id' => $productId
        ])->first();

        return $item;
    }

    /**
     * get all public by user id
     * @param $userId
     * @param $perPage
     * @return mixed
     */
    public function getAllPublicByUserID($userId, $perPage)
    {
        return $this->model->where([['user_id', '=', $userId],
            ['is_public', '=', 1],
            ['is_delete', '=', 0]])->paginate($perPage);
    }
}
