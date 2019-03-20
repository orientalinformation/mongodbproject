<?php

namespace App\Repositories\Research;


interface ResearchRepositoryInterface
{
	/**
	 * Save key searching value
	 * @param $request
	 */
	public function saveKeySearchingValue($request);

	/**
	 * find item limit
	 * @param $limit
	 */
	public function getListItem($limit);
}
