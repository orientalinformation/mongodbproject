<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
use App\Model\Bibliotheque;
use App\Model\BibliothequeDetail;
use Elasticsearch\ClientBuilder;
use App\Model\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Bibliotheque\BibliothequeRepositoryInterface;

class BibliothequeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Fake data for Bibliotheque
     * @return void
     */
    public function run()
    {
    	Bibliotheque::truncate();

        // delete Elastic Product Index
        $param = [
            'index' => Config::get('constants.elasticsearch.bibliotheque.index')
        ];
        $client = ClientBuilder::create()->build();
        // check index exists before delete
        if ($client->indices()->exists($param)) {
            $client->indices()->delete($param);
        }

        // add data to mongo db product table
    	$bibliothequeRepository = app(BibliothequeRepositoryInterface::class);
        $faker = Faker::create('fr');
        for ($i = 0; $i < 100; $i++) { 
            $title = $faker->text(20);
            $url = str_slug($title);
            $data = [
                'title'             => $title,
                'description'       => $faker->text(30),
                'url'               => $url,
                'image'             => '/image/front/Bibliotheque_Web_1.jpg', 
                'view'              => random_int(1, 2),
                'like'              => random_int(1, 99),
                'price'             => random_int(11, 99),
                'category_id'       => 1,
                'is_delete'         => '0',
            ];

            $bibliothequeCreate = Bibliotheque::create($data);

            $dataBibliothequeDetail = [
                'bibliotheque_id' => $bibliothequeCreate->id,
                'user_id' => 1,
                'share' => 0,
                'pink' => 0,
                'is_public' => 0,
                'is_delete' => 0,
            ];

            BibliothequeDetail::create($dataBibliothequeDetail);
        }

        // insert data to Elastic
        $bibliotheques = $bibliothequeRepository->all();
       	if (count($bibliotheques) > 0) {
       		foreach ($bibliotheques as $bibliotheque) {
                $bibliothequesDetail = BibliothequeDetail::where('bibliotheque_id', $bibliotheque->id)->first();
                if ($bibliothequesDetail) {
                    $dataElastic = [
                        'body' => [
                            'title'             => $bibliotheque->title,
                            'url'               => $bibliotheque->url,
                            'description'       => $bibliotheque->description,
                            'image'             => $bibliotheque->image,
                            'view'              => $bibliotheque->view,
                            'category_id'       => $bibliotheque->categoryId_id,
                            'like'              => $bibliotheque->like,
                            'price'             => $bibliotheque->price,
                            'user_id'           => $bibliothequesDetail->user_id,
                            'share'             => $bibliothequesDetail->share,
                            'pink'              => $bibliothequesDetail->pink,
                            'is_public'         => $bibliothequesDetail->is_public,
                            'is_delete'         => $bibliotheque->is_delete,
                            'updated_at'        => $bibliotheque->updated_at->format('Y-m-d H:i:s'),
                            'created_at'        => $bibliotheque->created_at->format('Y-m-d H:i:s'),
                        ],
                        'index' => Config::get('constants.elasticsearch.bibliotheque.index'),
                        'type' => Config::get('constants.elasticsearch.bibliotheque.type'),
                        'id' => $bibliotheque->id,
                    ];

                    $client = ClientBuilder::create()->build();
                    $client->index($dataElastic);
                }
       		}
           }
           // data for category
           $categoryRepository = app(CategoryRepositoryInterface::class);
           $categories = $categoryRepository->all();
           if(!count($categories) > 0) {
               $dataCategory = [
                'name' => 'Fillère',
                'alias' => '',
                'description' => 'Fillère',
                'parent_id' => '',
                'path'    => ''
               ];
               Category::create($dataCategory);
           }
    }
}
