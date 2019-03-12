<?php
/**
 * Created by PhpStorm.
 * User: trieunb
 * Date: 09/01/2019
 * Time: 13:46
 */

namespace App\Helpers\Envato;
use App\Model\Pin;

class Book
{
    public static function checkPinExist($itemID, $userID, $type) {
        $result = Pin::findByMultiWhere($itemID, $userID, $type)->toArray();
        if(sizeof($result)>0){
            return 1;
        }
        return 0;
    }
}