<?php
/**
 * Created by PhpStorm.
 * User: binhdq
 * Date: 14/03/2019
 * Time: 10:07
 */

namespace App\Repositories\BookDetail;


interface BookDetailRepositoryInterface
{
    /**
     * Get Check Liked
     * @return mixed
     */
    public function checkLiked($user_id, $book_id);

    /**
     * Get Check unLiked
     * @return mixed
     */
    public function checkunLiked($user_id, $book_id);

    public function getAllPublicByUserID($userId, $perPage);
}