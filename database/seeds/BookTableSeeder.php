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
use App\Repositories\Book\BookRepositoryInterface;

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
            'index' => Config::get('constants.elasticsearch.book.index')
        ];
        $client = ClientBuilder::create()->build();

        // check index exists before delete
        if ($client->indices()->exists($param)) {
            $client->indices()->delete($param);
        }

        $bookPath     = storage_path().'/book';
        // check folder library exist, if not then create one
        \File::isDirectory($bookPath) or \File::makeDirectory($bookPath, 0777, true, true);
        // copy image to storage/book
        $sourceFilePath  = public_path() . '/image/front/Bibliotheque_Web_1.jpg';
        $destinationPath = $bookPath . '/Bibliotheque_Web_1.jpg';
        $success         = \File::copy($sourceFilePath,$destinationPath);
        if($success) {
            echo 'Copy file complete!\n';
        }

        // add data to mongo db book table
        $bookRepository = app(BookRepositoryInterface::class);
        $categories = Category::all();
        if (count($categories) > 0) {
            $arrayCategory = [];
            foreach ($categories as $category) {
                $arrayCategory[] = $category->id;
            }

            $faker = Faker::create('fr');
            for ($i = 0; $i < 100; $i++) {
                $title = $faker->text(20);
                $alias = str_slug($title);
                $author = $faker->text(20);
                $type = Config::get('constants.objectType.book');
                $description = $faker->text(150);
                $image = '/image/front/Bibliotheque_Web_1.jpg';
                $file = '';
                $price = 100;
                $status = 1;
                $share = 0;
                $pink = 0;
                $view = 2;
                $like = 0;
                $isPublic = 1;
                $isDelete = 0;
                $isDelete = 0;
                $userId = 1;

                // random category id
                $arrayRand = array_rand($arrayCategory);
                $categoryId = $arrayCategory[$arrayRand];

                $data = [
                    'title'             => $title,
                    'alias'             => $alias,
                    'author'            => $author,
                    'type'              => $type,
                    'description'       => $description,
                    'image'             => $image,
                    'file'              => $file,
                    'price'             => $price,
                    'status'            => $status,
                    'share'             => $share,
                    'cat_id'            => $categoryId,
                    'view'              => $view,
                    'like'              => $like,
                    'is_public'         => $isPublic,
                    'is_delete'         => $isDelete,
                ];

                $bookCreate = Book::create($data);
                $dataBookDetail = [
                    'book_id'   => $bookCreate->id,
                    'user_id'   => $userId,
                    'share'     => $share,
                    'pink'      => $pink,
                    'is_like'   => $isPublic,
                    'is_delete' => $isDelete,
                ];

                BookDetail::create($dataBookDetail);
            }

            // insert data to Elastic
            $books = $bookRepository->all();
            if (count($books) > 0) {
                foreach ($books as $book) {
                    $bookDetail = BookDetail::where('book_id', $book->id)->first();
                    if ($bookDetail) {
                        $dataElastic = [
                            'body' => [
                                'id'               => $book->id,
                                'title'             => $book->title,
                                'alias'             => $book->alias,
                                'author'            => $book->author,
                                'type'              => $book->type,
                                'description'       => $book->description,
                                'image'             => $book->image,
                                'file'              => $book->file,
                                'price'             => $book->price,
                                'status'            => $book->status,
                                'share'             => $book->share,
                                'cat_id'            => $book->cat_id,
                                'view'              => $book->view,
                                'like'              => $book->like,
                                'is_public'         => $book->is_public,
                                'is_delete'         => $book->is_delete,
                                'updated_at'        => $book->updated_at->format('Y-m-d H:i:s'),
                                'created_at'        => $book->created_at->format('Y-m-d H:i:s'),
                            ],
                            'index' => Config::get('constants.elasticsearch.book.index'),
                            'type' => Config::get('constants.elasticsearch.book.type'),
                            'id' => $book->id,
                        ];

                        $client = ClientBuilder::create()->build();
                        $client->index($dataElastic);
                    }
                }
            }
        }
    }
}