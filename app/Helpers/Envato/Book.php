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

class BookHelper
{
    /**
     * @var LibraryDetailRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $librarydetailRepository;

    /**
     * LibraryDetailController constructor.
     * @param LibraryDetailRepositoryInterface $bookRepository
     */
    public function __construct(LibraryDetailRepositoryInterface $librarydetailRepository)
    {
        $this->librarydetailRepository = $librarydetailRepository;
    }

    public static function checkPinExist($itemID, $userID, $type) {
        $result = Pin::findByMultiWhere($itemID, $userID, $type)->toArray();
        if(sizeof($result)>0){
            return 1;
        }
        return 0;
    }

    public static function checkLibraryBook($library_id, $object_id) {
//        $result = $this->bookRepository->paginate($rowPage)->toArray();
        $type = Config::get('constants.objectType.book');
        $result = LibraryDetail::getLibraryDetail($library_id, $object_id, $type)->toArray();
        if(sizeof($result)>0){
            return 1;
        }
        return 0;
    }

    public static function getBookDetail($id) {
        $result = Book::getBookByID($id)->toArray();
        return $result;
    }
}