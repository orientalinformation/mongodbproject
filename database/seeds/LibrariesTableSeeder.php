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
        Library::truncate();

        // delete Elastic Product Index
        $param = [
            'index' => Config::get('constants.elasticsearch.library.index')
        ];
        $client = ClientBuilder::create()->build();
        // check index exists before delete
        if ($client->indices()->exists($param)) {
            $client->indices()->delete($param);
        }

        // add data to mongo db product table
    	$this->libraryRepository = app(LibraryRepositoryInterface::class);
        $faker = Faker::create('fr');
        for ($i = 0; $i < 100; $i++) { 
            $name = $faker->text(20);
            $url = str_slug($name);

            $data = [
                'name'              => $name,
                'description'       => $faker->text(30),
                'url'               => $url,
                'image'             => '/image/front/Bibliotheque_Web_1.jpg',
                'alias'             => '0',
                'share'             => 0,
                'view'              => random_int(1, 2),
                'like'              => random_int(1, 99),
                'price'             => random_int(11, 99),
                'category_id'       => 1,
                'user_id'           => 1,
                'is_public'         => 0,
                'is_delete'         => '0',
                'is_video'          => 0,
                'is_image'          => 0,
                'is_sound'          => 0
            ];

            $library = $this->libraryRepository->create($data);

            $dataLibraryDetail = [
                'library_id' => $library->id,
                'object_id' => 1,
                'user_id' => 1,
                'share' => 0,
                'pink' => 0,
                'is_like' => 0,
                'is_public' => 1,
                'is_delete' => 0,
            ];
            $this->libraryDetailRepo = app(LibraryDetailRepositoryInterface::class);
            $this->libraryDetailRepo->create($dataLibraryDetail);
        }

        // insert data to Elastic
        $bibliotheques = $this->libraryRepository->all();
       	if (count($bibliotheques) > 0) {
       		foreach ($bibliotheques as $bibliotheque) {
                $bibliothequesDetail = $this->libraryDetailRepo->getLibraryDetailById($bibliotheque->id);
                if ($bibliothequesDetail) {
                    $dataElastic = [
                        'body' => [
                            'name'             => $bibliotheque->name,
                            'url'               => $bibliotheque->url,
                            'description'       => $bibliotheque->description,
                            'image'             => $bibliotheque->image,
                            'alias'             => $bibliotheque->alias,
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
                        'index' => Config::get('constants.elasticsearch.library.index'),
                        'type' => Config::get('constants.elasticsearch.library.type'),
                        'id' => $bibliotheque->id,
                    ];

                    $client = ClientBuilder::create()->build();
                    $client->index($dataElastic);
                }
       		}
        }
    }
}
