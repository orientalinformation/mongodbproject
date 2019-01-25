<?php
/**
 * Created by PhpStorm.
 * User: trieunb
 * Date: 03/01/2019
 * Time: 10:53
 */

namespace App\Repositories;


abstract class EloquentRepository implements BaseRepositoryInterface
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;


    /**
     * EloquentRepository constructor.
     */
    public function __construct()
    {
        $this->setModel();
    }


    /**
     * Get model
     * @return mixed
     */
    abstract public function getModel();


    /**
     * Set model
     */
    public function setModel()
    {
        $this->model = app()->make($this->getModel());
    }

    /**
     * @inheritdoc
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * @inheritdoc
     */
    public function findByMany(array $ids)
    {
        $query = $this->model->query();

        return $query->whereIn("id", $ids)->get();
    }

    /**
     * @inheritdoc
     */
    public function findByColumn($columnName, $operator, $value)
    {
        return $this->model->where($columnName, $operator, $value)->get();
    }

    /**
     * @inheritdoc
     */
    public function checkRecordExists($columnName, $value)
    {
        return $this->model->where($columnName, '=', $value)->exists();
    }

    /**
     * @inheritdoc
     */
    public function findFirst($columnName, $value)
    {
        return $this->model->where($columnName, '=', $value)->first();
    }

    /**
     * @inheritdoc
     */
    public function getNameAndId()
    {
        return $this->model->pluck('name', 'id')->all();
    }

    /**
     * @inheritdoc
     */
    public function getIdArr()
    {
        return $this->model->pluck('id')->all();
    }

    /**
     * @inheritdoc
     */
    public function all()
    {
        return $this->model->orderBy('created_at', 'DESC')->get();
    }

    /**
     * @inheritdoc
     */
    public function paginate($perPage = 15)
    {
        return $this->model->orderBy('created_at', 'DESC')->paginate($perPage);
    }

    /**
     * @inheritdoc
     */
    public function paginateWithoutSort($perPage = 15)
    {
        return $this->model->paginate($perPage);
    }


    /**
     * @inheritdoc
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }


    /**
     * @inheritdoc
     */
    public function update($id, array $data)
    {
        $result = $this->find($id);

        if($result) {
            $result->update($data);
            return true;
        }

        return false;
    }


    /**
     * @inheritdoc
     */
    public function delete($id)
    {
        $result = $this->find($id);

        if($result) {
            $result->delete();
            return true;
        }

        return false;
    }

}