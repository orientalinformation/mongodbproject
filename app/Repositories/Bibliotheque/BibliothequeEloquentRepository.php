<?php

namespace App\Repositories\Bibliotheque;

use App\Model\Bibliotheque;
use App\Model\BibliothequeDetail;
use App\Repositories\EloquentRepository;
use Elasticsearch\ClientBuilder;
use App\Repositories\Bibliotheque\BibliothequeRepositoryInterface;

class BibliothequeEloquentRepository extends EloquentRepository implements BibliothequeRepositoryInterface
{
    public function getModel()
    {
        return Bibliotheque::class;
    }

    /**
	 *
	 * Search Bibliotheque By Keyword
	 *
	 * @param $keyword
     * @param $page
	 * @param $options
	 * @return array
	 */
    public function searchByKeyword($q = null, $page = 1, $options = null)
    {
        $result = [];
        return $result;
    }

    /**
     * get items by admin
     *
     * @param array $listAdminIds
     * @param int $limit
     * @return mixed
     */
    public function getItemsByadmin($listAdminIds, $limit)
    {
        $items = BibliothequeDetail::with('bibliotheque')
                            ->whereIn('user_id', $listAdminIds)
                            ->orderBy('_id', 'desc')
                            ->limit($limit)
                            ->get();

        return $items;
    }
}
