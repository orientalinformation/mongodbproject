<?php

namespace App\Repositories\Product;


interface ProductRepositoryInterface
{
	/**
     * Get Range year
     *
     * @param $start_year
     * @param $end_year
     * @param $perPage
     * @return mixed
     */
    public function getRange($start_year, $end_year, $perPage);
}
