<?php
/**
 * Created by PhpStorm.
 * User: trieunb
 * Date: 09/01/2019
 * Time: 16:00
 */

namespace App\Helpers\Envato;


class Ulities
{
    /**
     * Calculate page number from mongoDB
     * @param null $searchValue
     * @param int $page
     * @param int $rowTotal
     * @return array
     */
    public static function calculatorPage($searchValue = null, $page = 1, $rowTotal = 0, $rowPage = 0)
    {
        $pageNum = 0;
        $url = url()->current();

        if ($rowTotal > 0) {
            $pageNum = (int)($rowTotal/$rowPage);
            $pageNum += ($rowTotal % $rowPage) > 0 ? 1 : 0;
        }

        $prev = $page > 1 ? $url . ($searchValue ? '?q=' . $searchValue : '') . (is_null($searchValue) ? '?page=':'&page=' ) . ($page - 1): null;
        $next = $page < $pageNum ? $url . ($searchValue ? '?q=' . $searchValue : '') . (is_null($searchValue) ? '?page=':'&page=' ) . ($page + 1): null;
        $paginate = [
            'page'      => $page,
            'pageNum'   => $pageNum,
            'prev'      => $prev,
            'next'      => $next,
            'url'       => $url
        ];

        return $paginate;
    }
}