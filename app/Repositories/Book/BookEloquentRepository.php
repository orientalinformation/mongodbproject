<?php
/**
 * Created by PhpStorm.
 * User: trieunb
 * Date: 03/01/2019
 * Time: 11:13
 */

namespace App\Repositories\Book;


use App\Model\Book;
use App\Repositories\EloquentRepository;

class BookEloquentRepository extends EloquentRepository implements BookRepositoryInterface
{
    public function getModel()
    {
        return Book::class;
    }

    public function allByLimit($offset, $limit)
    {
        return $this->model->offset($offset)
                            ->limit($limit)
                            ->get();
    }

    public function checkStatus($bookID, $status)
    {
        return Book::where([['_id', '=', $bookID],
            ['status', '=', (int)$status]])->get();
    }

}