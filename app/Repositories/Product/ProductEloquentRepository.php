<?php

namespace App\Repositories\Product;


use App\Model\Product;
use App\Repositories\EloquentRepository;

class ProductEloquentRepository extends EloquentRepository implements ProductRepositoryInterface
{
    public function getModel()
    {
        return Product::class;
    }
}
