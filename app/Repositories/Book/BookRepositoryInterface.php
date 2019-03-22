<?php
/**
 * Created by PhpStorm.
 * User: trieunb
 * Date: 03/01/2019
 * Time: 11:12
 */

namespace App\Repositories\Book;


interface BookRepositoryInterface
{
    /**
     * Check Status
     * @return mixed
     */
    public function checkStatus($bookID, $status);

    /**
     * Get Draft
     * @return mixed
     */
    public function getDraft($perPage = 15);

    /**
     * Get Range year
     * @return mixed
     */
    public function getRange($start_year, $end_year, $perPage);

    /**
     * get items by admin
     *
     * @param array $listAdminIds
     * @param int $limit
     * @return mixed
     */
    public function getItemsByadmin($listAdminIds, $limit);

    /**
     * Get By CatID
     * @return mixed
     */
    public function getByCatID($catID, $perPage = 15);
}