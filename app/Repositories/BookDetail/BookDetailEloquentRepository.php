<?php
/**
 * Created by PhpStorm.
 * User: binhdq
 * Date: 14/03/2019
 * Time: 10:09
 */

namespace App\Repositories\BookDetail;


use App\Model\BookDetail;
use App\Repositories\EloquentRepository;

class BookDetailEloquentRepository extends EloquentRepository implements BookDetailRepositoryInterface
{
    public function getModel()
    {
        return BookDetail::class;
    }

    public function checkLiked($user_id, $book_id)
    {
        return BookDetail::where([['user_id', '=', $user_id],
            ['book_id', '=', $book_id],
            ['is_delete', '=', 0]])->get();
    }

    public function checkunLiked($user_id, $book_id)
    {
        return BookDetail::where([['user_id', '=', $user_id],
            ['book_id', '=', $book_id],
            ['is_delete', '=', 1]])->get();
    }

    public function checkShared($user_id, $book_id)
    {
        return BookDetail::where([['user_id', '=', $user_id],
            ['book_id', '=', $book_id],
            ['share', '=', 1],
            ['is_delete', '=', 0]])->get();
    }

    public function checkunShared($user_id, $book_id)
    {
        return BookDetail::where([['user_id', '=', $user_id],
            ['book_id', '=', $book_id],
            ['share', '=', 0],
            ['is_delete', '=', 0]])->get();
    }

    public function getAllPublicByUserID($userId, $perPage)
    {
        return BookDetail::where([['user_id', '=', $userId],
            ['is_public', '=', 1],
            ['is_delete', '=', 0]])->paginate($perPage);
    }
}