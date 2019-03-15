<?php

namespace App\Repositories\Product;

use App\Repositories\EloquentRepository;
use Elasticsearch\ClientBuilder;
use App\Model\Product;

class ProductEloquentRepository extends EloquentRepository implements ProductRepositoryInterface
{
    public function getModel()
    {
        return Product::class;
    }

    /**
	 * Search Product By Keyword
	 *
	 * @param $keyword
     * @param $page
	 * @param $options
	 * @return array
	 *
	 */
    public function searchByKeyword($q = null, $page = 1, $options = null)
    {
    	$limit = config('constants.rowPageProduct');
    	$offset = ($page > 1) ? ($page - 1) * $limit : 0;
        if (!isset($options) || $options == null) {
            if ($q != null) {
                $must = [
                    [
                        'match' => [
                            'is_delete' => 0
                        ]
                    ],
                    [
                        'match_phrase_prefix' => [
                            'title' => $q
                        ]
                    ]
                ];
            } else {
                $must = [
                    [
                        'match' => [
                            'is_delete' => 0
                        ]
                    ]
                ];
            }
        } else {
            if (isset($options['category'])) {
                $category = explode(',', $options['category']);
                if ($q != null) {
                    if (isset($options['start_year']) && isset($options['end_year'])) {
                        $must = [
                            [
                                'match' => [
                                    'is_delete' => 0
                                ]
                            ],
                            [
                                'match_phrase_prefix' => [
                                    'title' => $q
                                ],
                            ],
                            [
                                'range' => [
                                    'updated_at' => [
                                        'gte' => $options['start_year'],
                                        'lte' => $options['end_year'],
                                        'format' => 'yyyy||yyyy'
                                    ]
                                ]
                            ],
                            [
                                'terms' => [
                                    'category_id' => $category
                                ]
                            ]
                        ];
                    } else {
                        $must = [
                            [
                                'match' => [
                                    'is_delete' => 0
                                ]
                            ],
                            [
                                'match_phrase_prefix' => [
                                    'title' => $q
                                ],
                            ],
                            [
                                'terms' => [
                                    'category_id' => $category
                                ]
                            ]
                        ];
                    }
                    
                } else {
                    $must = [
                        [
                            'match' => [
                                'is_delete' => 0
                            ]
                        ],
                        [
                            'terms' => [
                                'category_id' => $category
                            ]
                        ]
                    ];
                }
            }

            if (!isset($options['category']) && isset($options['start_year']) && isset($options['end_year'])) {
                $must = [
                    [
                        'match' => [
                            'is_delete' => 0
                        ]
                    ],
                    [
                        'range' => [
                            'updated_at' => [
                                'gte' => $options['start_year'],
                                'lte' => $options['end_year'],
                                'format' => 'yyyy||yyyy'
                            ]
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
            'index' => config('constants.elasticsearch.product.index'),
            'type' => config('constants.elasticsearch.product.type'),
            'body' => [
                'from' => $offset,
                'size' => $limit,
                'query' => $query,
                'sort' => $sort
            ]
        ];

        $client = ClientBuilder::create()->build();
        $response = $client->search($params);

        $result = [];
        if (!empty($response)) {
            $result['total'] = $response['hits']['total'];
            $result['hits'] = $response['hits']['hits'];
        }

        return $result;
    }

    /**
     * Get Range year
     *
     * @param $start_year
     * @param $end_year
     * @param $perPage
     * @return mixed
     */
    public function getRange($start_year, $end_year, $perPage)
    {
        $startDate = Carbon::createFromDate($start_year, 1, 1);
        $endDate = Carbon::createFromDate($end_year, 12, 1);

        return Book::whereBetween('created_at', array($startDate, $endDate))->paginate($perPage);
    }
}
