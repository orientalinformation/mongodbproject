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
    public function getLibraryByUserID($userID, $perPage);

    public function getAllLibraryByUserID($userID);

    public function checkName($user_id, $name);
}