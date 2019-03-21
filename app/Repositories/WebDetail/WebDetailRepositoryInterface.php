<?php
/**
 * Created by PhpStorm.
 * User: binhdq
 * Date: 20/03/2019
 * Time: 14:25
 */

namespace App\Repositories\WebDetail;


interface WebDetailRepositoryInterface
{
    public function getAllPublicByUserID($userId, $perPage);
}