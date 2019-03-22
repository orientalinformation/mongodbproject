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

    /**
     * Get Check Liked
     *
     * @param int $userId
     * @param string $bibliothequeId
     * @return mixed
     */
    public function checkLiked($userId, $libraryId);

    /**
     * Get Check UnLiked
     *
     * @param int $userId
     * @param string $libraryId
     * @return mixed
     */
    public function checkunLiked($userId, $libraryId);

    /**
     * Get Check Shared
     *
     * @param int $userId
     * @param string $libraryId
     * @return mixed
     */
    public function checkShared($userId, $libraryId);
    
    public function getAllPublicByUserID($userId, $perPage);
}