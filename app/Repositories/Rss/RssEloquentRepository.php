<?php
/**
 * Created by PhpStorm.
 * User: trieunb
 * Date: 04/01/2019
 * Time: 11:39
 */

namespace App\Repositories\Rss;


use App\Model\Rss;
use App\Repositories\EloquentRepository;

class RssEloquentRepository extends EloquentRepository implements RssRepositoryInterface
{
    /**
     * @return mixed|string
     */
    public function getModel()
    {
        return Rss::class;
    }

    /**
     * @inheritdoc
     */
    public function mongoPaginate($columnName, array $ids, $perPage = 20)
    {
        return $this->model->whereIn($columnName, $ids)->orderBy('updated_at', 'DESC')->paginate($perPage);
    }
}