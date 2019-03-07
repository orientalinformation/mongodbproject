<?php

namespace App\Repositories\Product;


interface ProductRepositoryInterface
{
	/**
	 *
	 * Search Product By Keyword
	 *
	 * @param $keyword
	 * @param $page
	 * @param $options
	 * @return mixed
	 *
	 */
	
	public function searchByKeyword($keyword, $page, $options = null);
}
