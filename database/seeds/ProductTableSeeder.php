<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
use App\Model\Product;
use App\Model\ProductDetail;
use App\Model\ProductElastic;
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
    	Product::truncate();

        // delete Elastic Product Index
        $productElastic = new ProductElastic();
        $param = [
            'index' => $productElastic->getIndexName()
        ];
        $client = ClientBuilder::create()->build();
        // check index exists before delete
        if ($client->indices()->exists($param)) {
            $client->indices()->delete($param);
        }

        // add data to mongo db product table
    	$productRepository = app(ProductRepositoryInterface::class);
        $faker = Faker::create('fr');
        for ($i = 0; $i < 100; $i++) { 
        	$title = $faker->text(20);
            $url = str_slug($title);
        	$description = $faker->text(30);
        	$image = '/image/front/Bibliotheque_Web_1.jpg';
        	$view = 2;
        	$userId = 1;
        	$categoryId = 1;
        	$like = 0;
            $share = 0;
        	$pink = 0;
        	$isPublic = 0;
        	$isDelete = 0;
        	$createdAt = Carbon::now()->format('Y-m-d H:i:s');
            $updatedAt = Carbon::now()->format('Y-m-d H:i:s');

            $data = [
                'title'             => $title,
                'url'               => $url,
                'description'       => $description,
                'image'             => $image,
                'view'              => $view,
                'like'              => $like,
                'category_id'       => $categoryId,
                'is_delete'         => $isDelete,
                'created_at'        => $createdAt,
                'updated_at'        => $updatedAt,
            ];

            $productCreate = Product::create($data);
            $dataProductDetail = [
                'product_id' => $productCreate->id,
                'user_id' => $userId,
                'share' => $share,
                'pink' => $pink,
                'is_public' => $isPublic,
                'is_delete' => $isDelete,
            ];

            ProductDetail::create($dataProductDetail);
        }

        // insert data to Elastic
        $products = $productRepository->all();
       	if (count($products) > 0) {
       		foreach ($products as $product) {
                $productDetail = ProductDetail::where('product_id', $product->id)->first();
                if ($productDetail) {
                    $productDetailElatic = [
                        'id'            => $productDetail->id,
                        'product_id'    => $product->id,
                        'user_id'       => $productDetail->user_id,
                        'share'         => $productDetail->share,
                        'pink'          => $productDetail->pink,
                        'is_public'     => $productDetail->is_public,
                        'is_delete'     => $productDetail->is_delete,
                        'created_at'    => $productDetail->created_at,
                        'updated_at'    => $productDetail->updated_at,
                    ];

                    $dataElastic = [
                        'body' => [
                            'title'             => $product->title,
                            'url'               => $product->url,
                            'description'       => $product->description,
                            'image'             => $product->image,
                            'view'              => $product->view,
                            'category_id'       => $product->categoryId_id,
                            'like'              => $product->like,
                            'is_delete'         => $product->is_delete,
                            'created_at'        => $product->created_at,
                            'updated_at'        => $product->updated_at,
                            'product_detail'    => $productDetailElatic
                        ],
                        'index' => $productElastic->getIndexName(),
                        'type' => $productElastic->getTypeName(),
                        'id' => $product->id,
                    ];

                    $client = ClientBuilder::create()->build();
                    $client->index($dataElastic);
                }
       		}
       	}
    }
}
