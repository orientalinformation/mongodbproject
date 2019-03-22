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

    public function getAllPublicByUserID($userId, $perPage)
    {
        return LibraryDetail::where([['user_id', '=', $userId],
            ['is_public', '=', 1],
            ['is_delete', '=', 0]])->paginate($perPage);
    }
}