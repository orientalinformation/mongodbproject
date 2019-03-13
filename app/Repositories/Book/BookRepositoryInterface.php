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

    public function checkLiked($user_id, $book_id);
}