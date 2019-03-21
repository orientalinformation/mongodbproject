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

	/**
	 * get items by admin
	 *
	 * @param array $listAdminIds
	 * @param int $limit
	 * @return mixed
	 */
	public function getItemsByadmin($listAdminIds, $limit);
}
