<?php
/**
 * Created by PhpStorm.
 * User: binhdq
 * Date: 20/03/2019
 * Time: 15:06
 */

namespace App\Helpers\Envato;
use App\Model\Web;
use App\Repositories\BaseRepositoryInterface;
use App\Repositories\Web\WebRepositoryInterface;

class WebHelper
{
    /**
     * @var WebRepositoryInterface|BaseRepositoryInterface
     */
    private static $webRepository;

    public function __construct(WebRepositoryInterface $webRepository)
    {
        self::$webRepository = $webRepository;
    }

    /**
     * get eweb detail
     * @param $id
     * @return mixed
     */
    public static function getWebDetail($id) {
        $result = self::$webRepository->find($id);
        return $result;
    }
}