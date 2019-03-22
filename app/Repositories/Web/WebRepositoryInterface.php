<?php
/**
 * Created by PhpStorm.
 * User: trieunb
 * Date: 06/03/2019
 * Time: 15:51
 */

namespace App\Repositories\Web;


interface WebRepositoryInterface
{
	/**
	 * get items by admin
	 *
	 * @param int $limit
	 * @return mixed
	 */
	public function getItemsByadmin($limit);

    /**
     * get all web by user id
     * @param $userId
     * @param $perPage
     * @return mixed
     */
    public function getAllPublicByUserID($userId, $perPage);
}