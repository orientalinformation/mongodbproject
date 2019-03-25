<?php

use Carbon\Carbon;
use App\Model\Category;
use App\Model\Library;
use App\Model\LibraryDetail;
use Elasticsearch\ClientBuilder;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Library\LibraryRepositoryInterface;
use App\Repositories\LibraryDetail\LibraryDetailRepositoryInterface;

class LibrariesTableSeeder extends Seeder
{
    /**
     * @var LibraryRepositoryInterface|BaseRepositoryInterface
     */
    private $libraryRepository;

    /**
     * @var LibraryDetailRepositoryInterface|BaseRepositoryInterface
     */
    private $libraryDetailRepo;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Library::query()->delete();
    	LibraryDetail::query()->delete();

        // delete Elastic Library Index
        $param = [
            'index' => Config::get('constants.elasticsearch.library.index')
        ];
        $client = ClientBuilder::create()->build();

        // check index exists before delete
        if ($client->indices()->exists($param)) {
            $client->indices()->delete($param);
        }

        // add data to mongo db library table
    	$libraryRepository = app(LibraryRepositoryInterface::class);
        $categories = Category::all();
        if (count($categories) > 0) {
            $arrayCategory = [];
            foreach ($categories as $category) {
                $arrayCategory[] = $category->_id;
            }

            $faker = Faker::create('fr');
            for ($i = 0; $i < 100; $i++) { 
                $name = $faker->text(20);
                $url = str_slug($name);
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
                    'name'              => $name,
                    'description'       => $description,
                    'image'             => $image,
                    'user_id'           => $userId,
                    'category_id'       => $categoryId,
                    'alias'             => '',
                    'share'             => 0,
                    'url'               => $url,
                    'price'             => mt_rand(10,100),
                    'like'              => 0,
                    'view'              => $view,
                    'like'              => $like,
                    'is_public'         => $isPublic,
                    'is_delete'         => $isDelete,
                    'is_video'          => 0,
                    'is_image'          => 0,
                    'is_sound'          => 0,
                ];

                $libraryCreate = Library::create($data);
            }

            // insert data to Elastic
            $librarys = $libraryRepository->all();
            if (count($librarys) > 0) {
                foreach ($librarys as $library) {
                    $dataElastic = [
                        'body' => [
                            'name'             => $library->name,
                            'user_id'           => $library->user_id,
                            'category_id'       => $library->category_id,
                            'url'               => $library->url,
                            'description'       => $library->description,
                            'image'             => $library->image,
                            'view'              => $library->view,
                            'like'              => $library->like,
                            'is_public'         => $library->is_public,
                            'is_delete'         => $library->is_delete,
                            'updated_at'        => $library->updated_at->format('Y-m-d H:i:s'),
                            'created_at'        => $library->created_at->format('Y-m-d H:i:s'),
                            'alias'             => $library->alias,
                            'share'             => $library->share,
                            'price'             => $library->price,
                            'is_video'          => $library->is_video,
                            'is_image'          => $library->is_image,
                            'is_sound'          => $library->is_sound
                        ],
                        'index' => Config::get('constants.elasticsearch.library.index'),
                        'type' => Config::get('constants.elasticsearch.library.type'),
                        'id' => $library->id,
                    ];

                    $client = ClientBuilder::create()->build();
                    $client->index($dataElastic);
                }
            }
        }
    }
}
