<?php
/**
 * Created by PhpStorm.
 * User: binhdq
 * Date: 21/03/2019
 * Time: 10:18
 */

namespace App\Helpers\Envato;
use App\Model\Library;

class LibraryHelper
{
    public static function getLibraryDetail($id) {
        $result = Library::getLibraryByID($id)->toArray();
        return $result;
    }
}