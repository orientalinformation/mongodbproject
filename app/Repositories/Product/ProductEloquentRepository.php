<?php

namespace App\Repositories\Product;

use App\Repositories\EloquentRepository;
use Elasticsearch\ClientBuilder;
use App\Model\Product;
use App\Model\ProductElastic;

class ProductEloquentRepository extends EloquentRepository implements ProductRepositoryInterface
{
    public function getModel()
    {
        return Product::class;
    }

    /**
	 *
	 * Search Product By Keyword
	 *
	 * @param $keyword
     * @param $page
	 * @param $options
	 * @return array
	 *
	 */
    public function searchByKeyword($keyword = null, $page = 1, $options = null)
    {
    	$limit = 24;
    	$offset = ($page > 1) ? ($page - 1) * $limit : 0;
    	$productElastic = new ProductElastic();
        if ($keyword != null) {
            $should = [
                'match_phrase_prefix' => [
                    'title' => $keyword
                ]
            ];
        } else {
            $should = ['match_all' => new \stdClass()];
        }

        $query = [
            'constant_score' => [
                'filter' => [
                    'bool' => [
                        'must' => [
                            'match' => [
                                'is_delete' => 0
                            ]
                        ],
                        'should' => [
                            $should
                        ]
                    ]
                ]
            ]
        ];

        $sort = ['_id' => 'desc'];
        if (isset($options['sort'])) {
            $sort = ['_id' => $options['sort']];
        }

        $params = [
            'index' => $productElastic->getIndexName(),
            'type'  => $productElastic->getTypeName(),
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
}
