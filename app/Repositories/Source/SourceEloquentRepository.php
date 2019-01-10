<?php
/**
 * Created by PhpStorm.
 * User: trieunb
 * Date: 04/01/2019
 * Time: 11:39
 */

namespace App\Repositories\Source;


use App\Model\Source;
use App\Repositories\EloquentRepository;

class SourceEloquentRepository extends EloquentRepository implements SourceRepositoryInterface
{
    /**
     * @return mixed|string
     */
    public function getModel()
    {
        return Source::class;
    }

    /**
     * Get only technology
     * @return mixed
     */
    public function getTechnology()
    {
        return $this->model->technology()->get();
    }

    /**
     * Get only law document
     * @return mixed
     */
    public function getDocument()
    {
        return $this->model->document()->get();
    }
}