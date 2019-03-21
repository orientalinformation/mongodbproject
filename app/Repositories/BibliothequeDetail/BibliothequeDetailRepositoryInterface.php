<?php

namespace App\Repositories\BibliothequeDetail;


interface BibliothequeDetailRepositoryInterface
{
    /**
     * Get Check Liked
     *
     * @param int $userId
     * @param string $bibliothequeId
     * @return mixed
     */
    public function checkLiked($userId, $bibliothequeId);

    /**
     * Get Check unLiked
     *
     * @param int $userId
     * @param string $bibliothequeId
     * @return mixed
     */
    public function checkunLiked($userId, $bibliothequeId);

    /**
     * Get Check Shared
     *
     * @param int $userId
     * @param string $bibliothequeId
     * @return mixed
     */
    public function checkShared($userId, $bibliothequeId);

    /**
     * Get Check unShared
     *
     * @param int $userId
     * @param string $bibliothequeId
     * @return mixed
     */
    public function checkunShared($userId, $bibliothequeId);
}