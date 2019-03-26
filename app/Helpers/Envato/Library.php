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
    /**
     * @var LibraryRepositoryInterface|BaseRepositoryInterface
     */
    private static $libraryRepository;

    public function __construct(LibraryRepositoryInterface $libraryRepository)
    {
        self::$libraryRepository = $libraryRepository;
    }

    /**
     * get library detail
     * @param $id
     * @return mixed
     */
    public static function getLibraryDetail($id) {
        $result = self::$libraryRepository->getLibraryByID($id)->toArray();
        return $result;
    }
}