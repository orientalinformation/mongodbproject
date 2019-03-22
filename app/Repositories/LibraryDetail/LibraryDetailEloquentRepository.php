<?php
/**
 * Created by PhpStorm.
 * User: binhdq
 * Date: 18/03/2019
 * Time: 11:40
 */

namespace App\Repositories\LibraryDetail;


use App\Model\LibraryDetail;
use App\Model\Library;
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

    public function getLibraryDetail($library_id, $object_id, $type){
        return LibraryDetail::where([['library_id', '=', $library_id],
                                    ['object_id', '=', $object_id],
                                    ['type_name', '=', $type],
                                    ['is_delete', '=', 0]])->get();
    }

    public function getLibraryDetailExist($library_id, $object_id, $type){
        return LibraryDetail::where([['library_id', '=', $library_id],
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
        return LibraryDetail::where([
            ['user_id', '=', $userId],
            ['library_id', '=', $libraryId],
            ['is_delete', '=', 0]
        ])->get();
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
        return LibraryDetail::where([['user_id', '=', $userId],
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
    
    public function getAllPublicByUserID($userId, $perPage)
    {
        return LibraryDetail::where([['user_id', '=', $userId],
            ['is_public', '=', 1],
            ['is_delete', '=', 0]])->paginate($perPage);
    }
}