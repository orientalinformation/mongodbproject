<?php

namespace App\Repositories\Product;

use App\Repositories\EloquentRepository;
use Elasticsearch\ClientBuilder;
use App\Model\Product;

class ProductEloquentRepository extends EloquentRepository implements ProductRepositoryInterface
{
    public function getModel()
    {
        return Product::class;
    }

    /**
     * Get Range year
     *
     * @param $start_year
     * @param $end_year
     * @param $perPage
     * @return mixed
     */
    public function getRange($start_year, $end_year, $perPage)
    {
        $startDate = Carbon::createFromDate($start_year, 1, 1);
        $endDate = Carbon::createFromDate($end_year, 12, 1);

        return Book::whereBetween('created_at', array($startDate, $endDate))->paginate($perPage);
    }
}
