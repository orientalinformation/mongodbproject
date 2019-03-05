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
	 * @return mixed
	 *
	 */
	
	public function searchByKeyword($keyword, $page);
}
