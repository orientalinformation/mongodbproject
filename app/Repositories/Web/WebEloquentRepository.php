<?php
/**
 * Created by PhpStorm.
 * User: trieunb
 * Date: 06/03/2019
 * Time: 15:51
 */

namespace App\Repositories\Web;

use App\Model\Web;
use App\Repositories\EloquentRepository;

class WebEloquentRepository extends EloquentRepository implements WebRepositoryInterface
{
    /**
     * @return mixed|string
     */
    public function getModel()
    {
        return Web::class;
    }

    /**
	 * get items by admin
	 *
	 * @param int $limit
	 * @return mixed
	 */
	public function getItemsByadmin($limit)
	{
		$items = $this->model->orderBy('_id', 'desc')->limit($limit)->get();

		return $items;
	}

    /**
     * get all web by user id
     * @param $userId
     * @param $perPage
     * @return mixed
     */
    public function getAllPublicByUserID($userId, $perPage)
    {
        return Web::where([['user_id', '=', $userId],
            ['is_public', '=', 1],
            ['is_delete', '=', 0]])->paginate($perPage);
    }
}