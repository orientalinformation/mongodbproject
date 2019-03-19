<?php

namespace App\Repositories\Bibliotheque;


interface BibliothequeRepositoryInterface
{
	/**
	 * Search Bibliotheque By keyword
	 * @param $keyword
	 * @param $page
	 * @param $options
	 */
	public function searchByKeyword($keyword, $page, $options = null);
}
