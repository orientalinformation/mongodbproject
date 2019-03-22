<?php
/**
 * Created by PhpStorm.
 * User: binhdq
 * Date: 18/03/2019
 * Time: 11:42
 */


namespace App\Repositories\LibraryDetail;


interface LibraryDetailRepositoryInterface
{
    public function getLibraryDetail($library_id, $object_id, $type);

    public function getLibraryDetailExist($library_id, $object_id, $type);

    public function getAllPublicByUserID($userId, $perPage);
}