<?php

namespace App\Repositories\Product;


interface ProductRepositoryInterface
{
	/**
	 * Search Product By Keyword
	 * @param $keyword
	 * @param $page
	 * @param $options
	 */
	public function searchByKeyword($keyword, $page, $options = null);

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
