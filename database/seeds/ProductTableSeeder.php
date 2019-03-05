<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
use App\Model\Product;
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
    	$productRepository = app(ProductRepositoryInterface::class);
        $faker = Faker::create('fr');
        for ($i = 0; $i < 100; $i++) { 
        	$title = $faker->text(20);
        	$alias = str_slug($title);
        	$shortDescription = $faker->text(40);
        	$description = $faker->text(200);
        	$image = '/image/front/Bibliotheque_Web_1.jpg';
        	$price = 1;
        	$views = 2;
        	$userId = 1;
        	$catId = 1;
        	$like = 0;
        	$status = 0;
        	$share = 0;
        	$isPublic = 0;
        	$isDelete = 0;
        	$createdAt = Carbon::now()->format('Y-m-d H:i:s');
            $updatedAt = Carbon::now()->format('Y-m-d H:i:s');

            $data = [
                'title'             => $title,
                'alias'             => $alias,
                'shortDescription'  => $shortDescription,
                'description'       => $description,
                'image'             => $image,
                'price'             => $price,
                'views'             => $views,
                'userId'           	=> $userId,
                'catId'           	=> $catId,
                'like'           	=> $like,
                'status'           	=> $status,
                'share'           	=> $share,
                'is_public'         => $isPublic,
                'is_delete'         => $isDelete,
                'created_at'        => $createdAt,
                'updated_at'        => $updatedAt,
            ];

            Product::create($data);
        }

        // insert data to Elastic
        $products = $productRepository->all();
        $productElastic = new ProductElastic();
       	if (count($products) > 0) {
       		foreach ($products as $product) {
       			$dataElastic = [
                    'body' => [
                        'title'             => $product->title,
		                'alias'             => $product->alias,
		                'shortDescription'  => $product->shortDescription,
		                'description'       => $product->description,
		                'image'             => $product->image,
		                'price'             => $product->price,
		                'views'             => $product->views,
		                'userId'           	=> $product->userId,
		                'catId'           	=> $product->catId,
		                'like'           	=> $product->like,
		                'status'           	=> $product->status,
		                'share'           	=> $product->share,
		                'is_public'         => $product->isPublic,
		                'is_delete'         => $product->isDelete,
		                'created_at'        => $product->createdAt,
		                'updated_at'        => $product->updatedAt,
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
