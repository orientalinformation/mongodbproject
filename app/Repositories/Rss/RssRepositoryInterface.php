<?php
/**
 * Created by PhpStorm.
 * User: trieunb
 * Date: 04/01/2019
 * Time: 11:39
 */

namespace App\Repositories\Rss;


interface RssRepositoryInterface
{
    /**
     * paginate for mongo of rss
     * @param $columnName
     * @param array $ids
     * @param int $perPage
     * @return mixed
     */
    public function mongoPaginate($columnName, array $ids, $perPage = 20);
}