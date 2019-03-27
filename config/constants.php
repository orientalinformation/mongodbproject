<?php
/**
 * Created by PhpStorm.
 * User: trieunb
 * Date: 09/01/2019
 * Time: 16:26
 */

return [

    'rowPage'       => 24,
    'rowPageBook'   => 24,
    'itemSearchHome' => 3,
    'bookPath'  => '/storage/book/',
    'bookFilePath'  => '/storage/book/file/',
    'libraryPath'  => '/storage/library/',
    'avatarPath'  => '/storage/avatar/',
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
        ],
        'library' => [
            'index' => 'library_compagnons',
            'type'  => 'library'
        ]
    ],
    'objectType'    => [
        'product'   => 'PRODUCT',
        'book'      => 'BOOK',
        'library'   => 'LIBRARY'
    ]
];
