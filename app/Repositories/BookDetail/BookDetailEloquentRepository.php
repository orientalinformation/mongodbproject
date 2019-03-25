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
use Auth;

class BookDetailEloquentRepository extends EloquentRepository implements BookDetailRepositoryInterface
{
    public function getModel()
    {
        return BookDetail::class;
    }

    /**
     * check like
     * @param $user_id
     * @param $book_id
     * @return mixed
     */
    public function checkLiked($user_id, $book_id)
    {
        return BookDetail::where([['user_id', '=', $user_id],
            ['book_id', '=', $book_id],
            ['is_like', '=', 1],
            ['is_delete', '=', 0]])->get();
    }

    /**
     * check unlike
     * @param $user_id
     * @param $book_id
     * @return mixed
     */
    public function checkunLiked($user_id, $book_id)
    {
        return BookDetail::where([['user_id', '=', $user_id],
            ['book_id', '=', $book_id],
            ['is_delete', '=', 1]])->get();
    }

    /**
     * check share
     * @param $user_id
     * @param $book_id
     * @return mixed
     */
    public function checkShared($user_id, $book_id)
    {
        return BookDetail::where([['user_id', '=', $user_id],
            ['book_id', '=', $book_id],
            ['share', '=', 1],
            ['is_delete', '=', 0]])->get();
    }

    /**
     * check unshare
     * @param $user_id
     * @param $book_id
     * @return mixed
     */
    public function checkunShared($user_id, $book_id)
    {
        return BookDetail::where([['user_id', '=', $user_id],
            ['book_id', '=', $book_id],
            ['is_delete', '=', 1]])->get();
    }

    /**
     * check pin
     * @param $user_id
     * @param $book_id
     * @return mixed
     */
    public function checkPin($user_id, $book_id)
    {
        return BookDetail::where([['user_id', '=', (int)$user_id],
            ['book_id', '=', $book_id],
            ['is_delete', '=', 0]])->get();
    }

    /**
     * check unpin
     * @param $user_id
     * @param $book_id
     * @return mixed
     */
    public function checkunPin($user_id, $book_id)
    {
        return BookDetail::where([['user_id', '=', $user_id],
            ['book_id', '=', $book_id],
            ['is_delete', '=', 1]])->get();
    }

    /**
     * get all public by user id
     * @param $userId
     * @param $perPage
     * @return mixed
     */
    public function getAllPublicByUserID($userId, $perPage)
    {
        return BookDetail::where([['user_id', '=', $userId],
            ['is_delete', '=', 0]])->paginate($perPage);
    }

    /**
     * get product detail item
     *
     * @param string $productId
     * @return mixed
     */
    public function getDataItemUser($bookId)
    {
        $item = $this->model->where([
            'user_id'    => Auth::user()->id,
            'book_id' => $bookId
        ])->first();

        return $item;
    }
}