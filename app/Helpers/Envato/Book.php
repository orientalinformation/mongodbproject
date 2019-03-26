<?php
/**
 * Created by PhpStorm.
 * User: trieunb
 * Date: 09/01/2019
 * Time: 13:46
 */

namespace App\Helpers\Envato;
use App\Model\Pin;
use App\Model\LibraryDetail;
use App\Model\Book;
use App\Repositories\LibraryDetail\LibraryDetailRepositoryInterface;
use App\Repositories\Pin\PinRepositoryInterface;

class BookHelper
{
    /**
     * @var PinRepositoryInterface|BaseRepositoryInterface
     */
    private static $pinRepository;

    /**
     * @var LibraryDetailRepositoryInterface|BaseRepositoryInterface
     */
    private static $librarydetailRepository;

    /**
     * @var BookRepositoryInterface|BaseRepositoryInterface
     */
    private static $bookRepository;

    /**
     * LibraryDetailController constructor.
     * @param LibraryDetailRepositoryInterface $bookRepository
     */
    public function __construct(LibraryDetailRepositoryInterface $librarydetailRepository,
                                PinRepositoryInterface $pinRepository)
    {
        seft::$librarydetailRepository = $librarydetailRepository;
        seft::$pinRepository = $pinRepository;
    }

    /**
     * check pin exist
     * @param $itemID
     * @param $userID
     * @param $type
     * @return int
     */
    public static function checkPinExist($itemID, $userID, $type) {
        $result = self::$pinRepository->findByMultiWhere($itemID, $userID, $type)->toArray();
        if(sizeof($result)>0){
            return 1;
        }
        return 0;
    }

    /**
     * check library book
     * @param $library_id
     * @param $object_id
     * @return int
     */
    public static function checkLibraryBook($library_id, $object_id) {
        $type = Config::get('constants.objectType.book');
        $result = self::$librarydetailRepository->getLibraryDetail($library_id, $object_id, $type)->toArray();
        if(sizeof($result)>0){
            return 1;
        }
        return 0;
    }

    /**
     * get book detail
     * @param $id
     * @return mixed
     */
    public static function getBookDetail($id) {
        $result = Book::getBookByID($id)->toArray();
        return $result;
    }
}