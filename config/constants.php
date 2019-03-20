<?php
/**
 * Created by PhpStorm.
 * User: trieunb
 * Date: 09/01/2019
 * Time: 16:26
 */

return [

    'rowPage'       => 20,
    'rowPageBook'   => 24,
    'bookPath'  => '/public/upload/book/',
    'bookFilePath'  => '/public/upload/book/file/',
    'avatarPath'  => '/public/upload/avatar/',
    'elasticsearch' => [
        'web'       =>  [
            'index' =>  'web_compagnons',
            'type'  =>  'web'
        ],
        'book'      =>  [
            'index' =>  'book_compagnons',
            'type'  =>  'book'
        ],
        'product'   =>  [
            'index' =>  'product_compagnons',
            'type'  =>  'product'
        ],
        'reporting' =>  [
            'index' =>  'reporting_compagnons',
            'type'  =>  'reporting'
        ],
        'event'     =>  [
            'index' =>  'event_compagnons',
            'type'  =>  'event'
        ],
        'bibliotheque' => [
            'index' => 'bibliotheque_compagnons',
            'type'  => 'bibliotheque'
        ]
    ],
    'objectType'    => [
        'product'   => 'PRODUCT',
        'book'      => 'BOOK'
    ]
];
