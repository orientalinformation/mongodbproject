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
}
