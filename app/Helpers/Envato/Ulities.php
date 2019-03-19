<?php
/**
 * Created by PhpStorm.
 * User: trieunb
 * Date: 09/01/2019
 * Time: 16:00
 */

namespace App\Helpers\Envato;
use \DateTime;
use Elasticsearch\ClientBuilder;


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

    public static function limit($value, $limit = 100, $end = '...')
    {
        if (mb_strwidth($value, 'UTF-8') <= $limit) {
            return $value;
        }

        return rtrim(mb_strimwidth($value, 0, $limit, '', 'UTF-8')).$end;
    }

    public static function number_format_short( $n, $precision = 1 ) {
        if ($n < 900) {
            // 0 - 900
            $n_format = number_format($n, $precision);
            $suffix = '';
        } else if ($n < 900000) {
            // 0.9k-850k
            $n_format = number_format($n / 1000, $precision);
            $suffix = 'K';
        } else if ($n < 900000000) {
            // 0.9m-850m
            $n_format = number_format($n / 1000000, $precision);
            $suffix = 'M';
        } else if ($n < 900000000000) {
            // 0.9b-850b
            $n_format = number_format($n / 1000000000, $precision);
            $suffix = 'B';
        } else {
            // 0.9t+
            $n_format = number_format($n / 1000000000000, $precision);
            $suffix = 'T';
        }
        // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
        // Intentionally does not affect partials, eg "1.50" -> "1.50"
        if ( $precision > 0 ) {
            $dotzero = '.' . str_repeat( '0', $precision );
            $n_format = str_replace( $dotzero, '', $n_format );
        }
        return $n_format . $suffix;
    }

    public static function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

    /**
     * Search Elastic
     *
     * @param string $indexName
     * @param string $typeName
     * @param array $options
     * @return array
     */
    public static function getElasticParams($indexName, $typeName, $options)
    {
        $limit = $options['limit'];
        $offset = ($options['page'] > 1) ? ($options['page'] - 1) * $limit : 0;
        $must[] = [
            'match' => [
                'is_delete' => 0
            ]
        ];
        if ($options != null) {
            if (isset($options['q'])) {
                $must[] = [
                    'match_phrase_prefix' => [
                        'title' => $options['q']
                    ]
                ];
            }

            if (isset($options['category'])) {
                $category = $options['category'];
                $must[] = [
                    'terms' => [
                        'category_id' => $category
                    ]
                ];
            }

            if (isset($options['start_year']) && isset($options['end_year'])) {
                $must[] = [
                    'range' => [
                        'updated_at' => [
                            'gte' => $options['start_year'],
                            'lte' => $options['end_year'],
                            'format' => 'yyyy||yyyy'
                        ]
                    ]
                ];
            }
        }

        $query = [
            'bool' => [
                'must' => $must
            ]
        ];

        $sort = ['_id' => 'desc'];
        if (isset($options['sort'])) {
            $sort = ['_id' => $options['sort']];
        }

        $params = [
            'index' => $indexName,
            'type' => $typeName,
            'body' => [
                'from' => $offset,
                'size' => $limit,
                'query' => $query,
                'sort' => $sort
            ]
        ];

        return $params;
    }
}
