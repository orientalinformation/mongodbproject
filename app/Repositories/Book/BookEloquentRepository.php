<?php
/**
 * Created by PhpStorm.
 * User: trieunb
 * Date: 03/01/2019
 * Time: 11:13
 */

namespace App\Repositories\Book;


use App\Model\Book;
use App\Model\BookDetail;
use App\Repositories\EloquentRepository;
use Carbon\Carbon;
use DB;

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

    public function getDraft($perPage = 15)
    {
        return Book::where([['status', '=', 'DRAFT']])->paginate($perPage);
    }

    public function getRange($start_year, $end_year, $perPage)
    {
        $startDate = Carbon::createFromDate($start_year, 1, 1);
        $endDate = Carbon::createFromDate($end_year, 12, 1);

        return Book::whereBetween('created_at', array($startDate, $endDate))->paginate($perPage);
    }

    /**
     * get items by admin
     *
     * @param array $listAdminIds
     * @param int $limit
     * @return mixed
     */
    public function getItemsByadmin($listAdminIds, $limit)
    {
        $items = BookDetail::with('book')
                            ->whereIn('user_id', $listAdminIds)
                            ->orderBy('_id', 'desc')
                            ->limit($limit)
                            ->get();

        return $items;
    }

    public function getByCatID($catID, $perPage = 15)
    {
        return Book::where([['cat_id', '=', $catID]])->paginate($perPage);
    }
}