<?php

namespace App\Model;

use Illuminate\Support\Facades\App;
use Jenssegers\Mongodb\Eloquent\Model;

class Pin extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'pins';
    public $translatedAttributes = [];
    protected $fillable = [
        'itemID', 'type', 'userID'
    ];

    static function findByMultiWhere($itemID, $userID, $type)
    {
        return Pin::where([['itemID', '=', $itemID],
            ['userID', '=', (int)$userID],
            ['type', '=', $type]])->get();
    }

    public function checkPinExistAttribute($type, $itemId)
    {
        $userId = 1; //
        return Pin::findByMultiWhere($itemId, $userId, $type);
    }
}
