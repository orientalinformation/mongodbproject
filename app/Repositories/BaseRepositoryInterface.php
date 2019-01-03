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
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id);


    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes);


    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, array $attributes);


    /**
     * Delete
     * @param $id
     * @return mixed
     */
    public function delete($id);

}