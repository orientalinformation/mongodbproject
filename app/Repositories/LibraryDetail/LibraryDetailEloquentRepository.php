<?php
/**
 * Created by PhpStorm.
 * User: binhdq
 * Date: 18/03/2019
 * Time: 11:40
 */

namespace App\Repositories\LibraryDetail;

use App\Model\LibraryDetail;
use App\Repositories\EloquentRepository;

class LibraryDetailEloquentRepository extends EloquentRepository implements LibraryDetailRepositoryInterface
{

    /**
     * Get model
     * @return mixed
     */
    public function getModel()
    {
        return LibraryDetail::class;
    }

    /**
     * get library detail
     * @param $library_id
     * @param $object_id
     * @param $type
     * @return mixed
     */
    public function getLibraryDetail($library_id, $object_id, $type){
        return $this->model->where([['library_id', '=', $library_id],
                                    ['object_id', '=', $object_id],
                                    ['type_name', '=', $type],
                                    ['is_delete', '=', 0]])->get();
    }

    /**
     * get library detail exist
     * @param $library_id
     * @param $object_id
     * @param $type
     * @return mixed
     */
    public function getLibraryDetailExist($library_id, $object_id, $type){
        return $this->model->where([['library_id', '=', $library_id],
            ['object_id', '=', $object_id],
            ['type_name', '=', $type],
            ['is_delete', '=', 1]])->get();
    }

    /**
     * Get Check Liked
     *
     * @param int $userId
     * @param string $libraryId
     * @return mixed
     */
    public function checkLiked($userId, $libraryId)
    {
        return $this->model->where([
            ['user_id', '=', $userId],
            ['library_id', '=', $libraryId],
            ['is_like', '=', 1],
            ['is_delete', '=', 0]])->get();
    }

    /**
     * Get Check UnLiked
     *
     * @param int $userId
     * @param string $libraryId
     * @return mixed
     */
    public function checkunLiked($userId, $libraryId)
    {
        return $this->model->where([['user_id', '=', $userId],
            ['library_id', '=', $libraryId],
            ['is_delete', '=', 1]])->get();
    }

    /**
     * Get Check Shared
     *
     * @param    int       $userId
     * @param    string    $libraryId
     * @return   mixed
     */
    public function checkShared($userId, $libraryId)
    {
        $libDetailModel = $this->model;
        return $libDetailModel::where([
            ['user_id', '=', $userId],
            ['library_id', '=', $libraryId],
            ['share', '=', 1],
            ['is_delete', '=', 0]
        ])->get();
    }

    /**
     * get all public by user id
     * @param $userId
     * @param $perPage
     * @return mixed
     */
    public function getAllPublicByUserID($userId, $perPage)
    {
        return $this->model->where([['user_id', '=', $userId],
            ['is_public', '=', 1],
            ['is_delete', '=', 0]])->paginate($perPage);
    }

    /**
     * Get library detail
     * @param int $libraryId
     * @return mixed
     */
    public function getLibraryDetailById($libraryId = null)
    {
        $libDetailModel = $this->model;
        return $libDetailModel::where([['library_id', '=', $libraryId]])->first();
    }

    /**
     * Get Check unShare
     *
     * @param int $userId
     * @param string $libraryId
     * @return mixed
     */
    public function checkunShare($userId, $libraryId)
    {
        return $this->model->where([
            ['user_id', '=', $userId],
            ['library_id', '=', $libraryId],
            ['is_delete', '=', 1]
        ])->get();
    }

    /**
     * check pin
     * @param $userId
     * @param $libraryId
     * @return mixed
     */
    public function checkPin($userId, $libraryId)
    {
        return $this->model->where([
            ['user_id', '=', $userId],
            ['library_id', '=', $libraryId],
            ['pink', '=', 1],
            ['is_delete', '=', 0]
        ])->get();
    }

    /**
     * check unpin
     * @param $userId
     * @param $libraryId
     * @return mixed
     */
    public function checkunPin($userId, $libraryId)
    {
        return $this->model->where([
            ['user_id', '=', $userId],
            ['library_id', '=', $libraryId],
            ['is_delete', '=', 1]
        ])->get();
    }
}