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

    public static function uploadFile($file, $typePath, $extension)
    {
        $datePath = date("Y") . '/' . date("m") . '/' . date("d");
        $typePath = base_path() . $typePath;
        $filePath = $typePath . $datePath;
        $fileName = date('U') . '-' . $file->getClientOriginalName();
        $fileExtension = $file->getClientOriginalExtension();
        $data = [];
        if (in_array($fileExtension, $extension)) {
            //make directory
            @mkdir($filePath, 0777, true);
            //move from temp path to upload store
            $file->move($filePath, $fileName);
            $data['status'] = 1;
            $data['data'] = $datePath . '/' . $fileName;
        }else{
            $data['status'] = 0;
            $data['data'] = "Extension is not valid";
        }
        return $data;
    }

    public static function is_url_exist($url){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if($code == 200){
            $status = true;
        }else{
            $status = false;
        }
        curl_close($ch);
        return $status;
    }
}