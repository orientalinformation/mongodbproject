<?php
/**
 * Created by PhpStorm.
 * User: trieunb
 * Date: 03/01/2019
 * Time: 11:12
 */

namespace App\Repositories\Book;


interface BookRepositoryInterface
{
    public function checkStatus($bookID, $status);

    public function getDraft($perPage = 15);
}