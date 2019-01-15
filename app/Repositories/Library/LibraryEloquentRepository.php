<?php
/**
 * Created by PhpStorm.
 * User: binhdq
 * Date: 15/01/2019
 * Time: 09:29
 */

namespace App\Repositories\Library;


use App\Model\Library;
use App\Repositories\EloquentRepository;

class LibraryEloquentRepository extends EloquentRepository implements LibraryRepositoryInterface
{

    /**
     * Get model
     * @return mixed
     */
    public function getModel()
    {
        return Library::class;
    }

    public function getLibraryByUserID($userID, $perPage)
    {
        return Library::where([['userID', '=', $userID]])->paginate($perPage);
    }

    public function checkShare($id, $share)
    {
        return Library::where([['_id', '=', $id],
                                ['share', '=', (int)$share]])->get();
    }
}