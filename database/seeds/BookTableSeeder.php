<?php
/**
 * Created by PhpStorm.
 * User: binhdq
 * Date: 20/03/2019
 * Time: 11:09
 */

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
use App\Model\Book;
use App\Model\BookDetail;
use App\Model\Category;
use Elasticsearch\ClientBuilder;
use App\Repositories\Product\ProductRepositoryInterface;

class BookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Book::query()->delete();
        BookDetail::query()->delete();

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
                $arrayCategory[] = $category->_id;
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
                    'title'             => $title,
                    'url'               => $url,
                    'description'       => $description,
                    'image'             => $image,
                    'view'              => $view,
                    'like'              => $like,
                    'category_id'       => $categoryId,
                    'is_delete'         => $isDelete,
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
                        $dataElastic = [
                            'body' => [
                                'title'             => $product->title,
                                'url'               => $product->url,
                                'description'       => $product->description,
                                'image'             => $product->image,
                                'view'              => $product->view,
                                'category_id'       => $product->category_id,
                                'like'              => $product->like,
                                'user_id'           => $productDetail->user_id,
                                'share'             => $productDetail->share,
                                'pink'              => $productDetail->pink,
                                'is_public'         => $productDetail->is_public,
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
}