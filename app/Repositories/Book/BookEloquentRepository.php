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

    /**
     * check status
     * @param $bookID
     * @param $status
     * @return mixed
     */
    public function checkStatus($bookID, $status)
    {
        return $this->model->where([['_id', '=', $bookID],
            ['status', '=', (int)$status]])->get();
    }

    /**
     * get draft
     * @param int $perPage
     * @return mixed
     */
    public function getDraft($perPage = 15)
    {
        return $this->model->where([['status', '=', 'DRAFT']])->paginate($perPage);
    }

    /**
     * get range
     * @param $start_year
     * @param $end_year
     * @param $perPage
     * @return mixed
     */
    public function getRange($start_year, $end_year, $perPage)
    {
        $startDate = Carbon::createFromDate($start_year, 1, 1);
        $endDate = Carbon::createFromDate($end_year, 12, 1);

        return $this->model->whereBetween('created_at', array($startDate, $endDate))->paginate($perPage);
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
        $items = $this->model->with('book')
                            ->whereIn('user_id', $listAdminIds)
                            ->orderBy('_id', 'desc')
                            ->limit($limit)
                            ->get();

        return $items;
    }

    /**
     * get by cat id
     * @param $catID
     * @param int $perPage
     * @return mixed
     */
    public function getByCatID($catID, $perPage = 15)
    {
        return $this->model->where([['cat_id', '=', (int)$catID]])->paginate($perPage);
    }

    /**
     * paginate by title sort
     * @param $sort
     * @param int $perPage
     * @return mixed
     */
    public function paginateByTitleSort($sort, $perPage = 15)
    {
        return $this->model->orderBy('title', $sort)->paginate($perPage);
    }
}