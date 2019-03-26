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

    /**
     * get all public by user id
     * @param $userId
     * @param $perPage
     * @return mixed
     */
    public function getAllPublicByUserID($userId, $perPage);

    /**
     * Get library detail
     * @param int $libraryId
     * @return mixed
     */
    public function getLibraryDetailById($libraryId = null);

    /**
     * Get Check UnLiked
     *
     * @param int $userId
     * @param string $libraryId
     * @return mixed
     */
    public function checkunShare($userId, $libraryId);

    /**
     * check pin
     * @param $userId
     * @param $libraryId
     * @return mixed
     */
    public function checkPin($userId, $libraryId);

    /**
     * check unpin
     * @param $userId
     * @param $libraryId
     * @return mixed
     */
    public function checkunPin($userId, $libraryId);
}