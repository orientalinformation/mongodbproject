<?php

namespace App\Repositories\BibliothequeDetail;

use App\Model\BibliothequeDetail;
use App\Repositories\EloquentRepository;
use Elasticsearch\ClientBuilder;
use App\Repositories\BibliothequeDetail\BibliothequeDetailRepositoryInterface;

class BibliothequeDetailEloquentRepository extends EloquentRepository implements BibliothequeDetailRepositoryInterface
{
    public function getModel()
    {
        return BibliothequeDetail::class;
    }

    /**
     * Get Check Liked
     *
     * @param int $userId
     * @param string $bibliothequeId
     * @return mixed
     */
    public function checkLiked($userId, $bibliothequeId)
    {
        return BibliothequeDetail::where([
            ['user_id', '=', $userId],
            ['bibliotheque_id', '=', $bibliothequeId],
            ['is_delete', '=', 0]
        ])->get();
    }

    /**
     * Get Check unLiked
     *
     * @param int $userId
     * @param string $bibliothequeId
     * @return mixed
     */
    public function checkunLiked($userId, $bibliothequeId)
    {
        return BibliothequeDetail::where([['user_id', '=', $userId],
            ['product_id', '=', $bibliothequeId],
            ['is_delete', '=', 1]])->get();
    }

    /**
     * Get Check Shared
     *
     * @param int $userId
     * @param string $bibliothequeId
     * @return mixed
     */
    public function checkShared($userId, $bibliothequeId)
    {
        return BibliothequeDetail::where([['user_id', '=', $userId],
            ['product_id', '=', $bibliothequeId],
            ['share', '=', 1],
            ['is_delete', '=', 0]])->get();
    }

    /**
     * Get Check unShared
     *
     * @param int $userId
     * @param string $bibliothequeId
     * @return mixed
     */
    public function checkunShared($userId, $bibliothequeId)
    {
        return BibliothequeDetail::where([['user_id', '=', $userId],
            ['product_id', '=', $bibliothequeId],
            ['share', '=', 0],
            ['is_delete', '=', 0]])->get();
    }
}
