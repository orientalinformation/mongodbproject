<?php
/**
 * Created by PhpStorm.
 * User: trieunb
 * Date: 03/01/2019
 * Time: 10:52
 */

namespace App\Repositories;


interface BaseRepositoryInterface
{
    /**
     * Get All
     * @return mixed
     */
    public function all();


    /**
     * Get all data pagination
     * @return mixed
     */
    public function paginate();

    /**
     * Get all data pagination without sort
     * @return mixed
     */
    public function paginateWithoutSort($perPage = 15);


    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * Get data with id array
     * @param array $ids
     * @return mixed
     */
    public function findByMany(array $ids);

    /**
     * Get data from columnName with many values
     * @param $columnName
     * @param array $ids
     * @return mixed
     */
    public function findByColumnManyValue($columnName, array $ids);

    /**
     * Find by column
     * @param $columnName
     * @param $operator
     * @param $value
     * @return mixed
     */
    public function findByColumn($columnName, $operator, $value);

    /**
     * Check record exists
     * @param $columnName
     * @param $value
     * @return mixed
     */
    public function checkRecordExists($columnName, $value);

    /**
     * find and get first record
     * @param $columnName
     * @param $value
     * @return mixed
     */
    public function findFirst($columnName, $value);


    /**
     * Get name and id
     * @return mixed
     */
    public function getNameAndId();

    /**
     * Get id array
     * @return mixed
     */
    public function getIdArr();

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create(array $data);


    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, array $data);


    /**
     * Delete
     * @param $id
     * @return mixed
     */
    public function delete($id);


}