<?php
/**
 * Created by PhpStorm.
 * User: trieunb
 * Date: 04/01/2019
 * Time: 11:39
 */

namespace App\Repositories\Source;


interface SourceRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getTechnology();

    /**
     * @return mixed
     */
    public function getDocument();
}