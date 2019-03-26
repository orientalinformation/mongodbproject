<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
use App\Model\Product;
use App\Model\ProductDetail;
use App\Model\Category;
use Elasticsearch\ClientBuilder;
use App\Repositories\Product\ProductRepositoryInterface;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::query()->delete();
    	ProductDetail::query()->delete();

        // delete Elastic Product Index
        $param = [
            'index' => Config::get('constants.elasticsearch.product.index')
        ];
        $client = ClientBuilder::create()->build();

        // check index exists before delete
        if ($client->indices()->exists($param)) {
            $client->indices()->delete($param);
        }

        // add data to mongo db product table
    	$productRepository = app(ProductRepositoryInterface::class);
        $categories = Category::all();
        if (count($categories) > 0) {
            $arrayCategory = [];
            foreach ($categories as $category) {
                $arrayCategory[] = $category->id;
            }

            $faker = Faker::create('fr');
            for ($i = 0; $i < 100; $i++) { 
                $title = $faker->text(20);
                $url = str_slug($title);
                $description = $faker->text(150);
                $image = '/image/front/Bibliotheque_Web_1.jpg';
                $view = 2;
                $userId = 1;
                $like = 0;
                $share = 0;
                $pink = 0;
                $isPublic = 1;
                $isDelete = 0;

                // random category id
                $arrayRand = array_rand($arrayCategory);
                $categoryId = $arrayCategory[$arrayRand];

                $data = [
                    'user_id'           => $userId,
                    'category_id'       => $categoryId,
                    'title'             => $title,
                    'url'               => $url,
                    'description'       => $description,
                    'image'             => $image,
                    'view'              => $view,
                    'like'              => $like,
                    'is_public'         => $isPublic,
                    'is_delete'         => $isDelete,
                ];

                $productCreate = Product::create($data);
            }

            // insert data to Elastic
            $products = $productRepository->all();
            if (count($products) > 0) {
                foreach ($products as $product) {
                    $dataElastic = [
                        'body' => [
                            'user_id'           => $product->user_id,
                            'category_id'       => $product->category_id,
                            'title'             => $product->title,
                            'url'               => $product->url,
                            'description'       => $product->description,
                            'image'             => $product->image,
                            'view'              => $product->view,
                            'like'              => $product->like,
                            'is_public'         => $product->is_public,
                            'is_delete'         => $product->is_delete,
                            'updated_at'        => $product->updated_at->format('Y-m-d H:i:s'),
                            'created_at'        => $product->created_at->format('Y-m-d H:i:s'),
                        ],
                        'index' => Config::get('constants.elasticsearch.product.index'),
                        'type' => Config::get('constants.elasticsearch.product.type'),
                        'id' => $product->id,
                    ];

                    $client = ClientBuilder::create()->build();
                    $client->index($dataElastic);
                }
            }
        }
    }
}
