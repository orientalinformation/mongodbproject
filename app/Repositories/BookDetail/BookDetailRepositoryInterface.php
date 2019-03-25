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
     * check like
     * @param $user_id
     * @param $book_id
     * @return mixed
     */
    public function checkLiked($user_id, $book_id);

    /**
     * check unlike
     * @param $user_id
     * @param $book_id
     * @return mixed
     */
    public function checkunLiked($user_id, $book_id);

    /**
     * check share
     * @param $user_id
     * @param $book_id
     * @return mixed
     */
    public function checkShared($user_id, $book_id);

    /**
     * check unshare
     * @param $user_id
     * @param $book_id
     * @return mixed
     */
    public function checkunShared($user_id, $book_id);

    /**
     * check pin
     * @param $user_id
     * @param $book_id
     * @return mixed
     */
    public function checkPin($user_id, $book_id);

    /**
     * get all public by user id
     * @param $userId
     * @param $perPage
     * @return mixed
     */
    public function getAllPublicByUserID($userId, $perPage);

    /**
     * get product detail item
     * @param $productId
     * @return mixed
     */
    public function getDataItemUser($productId);
}