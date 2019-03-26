<?php
/**
 * Created by PhpStorm.
 * User: binhdq
 * Date: 15/01/2019
 * Time: 09:31
 */

namespace App\Repositories\Library;


interface LibraryRepositoryInterface
{
    /**
     * get library by user id
     * @param $userID
     * @param $perPage
     * @return mixed
     */
    public function getLibraryByUserID($userID, $perPage);

    /**
     * check name
     * @param $user_id
     * @param $name
     * @return mixed
     */
    public function checkName($user_id, $name);

    /**
     * get all library by user id
     * @param $userId
     * @return mixed
     */
    public function getAllLibraryByUserID($userId);
}