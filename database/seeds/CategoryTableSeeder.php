<?php

use Illuminate\Database\Seeder;
use App\Model\Category;
use Carbon\Carbon;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\BaseRepositoryInterface;

class CategoryTableSeeder extends Seeder
{
    /**
     * @var CategoryRepositoryInterface|BaseRepositoryInterface
     */
    private $categoryRepository;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::query()->delete();

        // Categories for level 1
        $categoriesLevel1 = [
            [
                'parent_id'     => null,
                'name'          => 'Bois',
                'description'   => 'Bois',
                'path'          => null,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'parent_id'     => null,
                'name'          => 'Pierre',
                'description'   => 'Pierre',
                'path'          => null,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ];

        $this->categoryRepository = app(CategoryRepositoryInterface::class);

        foreach ($categoriesLevel1 as $category) {
            $result = $this->categoryRepository->create($category);
            $id = $result->_id;
            $data = [
                'path'  => $id
            ];

            $this->categoryRepository->update($id, $data);
        }

        //Categories for level 2
        $categoriesLevel2 = [
            [
                'parent_id'     => null,
                'name'          => 'Logiciel',
                'description'   => 'Logiciel',
                'path'          => null,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'parent_id'     => null,
                'name'          => 'Outil',
                'description'   => 'Outil',
                'path'          => null,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'parent_id'     => null,
                'name'          => 'Règlementaires et normes',
                'description'   => 'Règlementaires et normes',
                'path'          => null,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'parent_id'     => null,
                'name'          => 'Transition',
                'description'   => 'Transition',
                'path'          => null,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'parent_id'     => null,
                'name'          => 'Matériaux',
                'description'   => 'Matériaux',
                'path'          => null,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'parent_id'     => null,
                'name'          => 'Matériaux',
                'description'   => 'Matériaux',
                'path'          => null,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'parent_id'     => null,
                'name'          => 'Produit',
                'description'   => 'Produit',
                'path'          => null,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],


        ];

        $level1 = $this->categoryRepository->all();

        foreach ($level1 as $level) {
            foreach ($categoriesLevel2 as $level2) {
                $level2['parent_id'] = $level->_id;
                $result = $this->categoryRepository->create($level2);
                $id = $result->_id;

                $data = [
                    'path'  => $level->_id . '/' . $id
                ];

                $this->categoryRepository->update($id, $data);

            }
        }

        //Categories for level 3
        $categoriesLevel3 = [
            [
                'parent_id'     => null,
                'name'          => 'CAO',
                'description'   => 'CAO',
                'path'          => null,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'parent_id'     => null,
                'name'          => 'DAO',
                'description'   => 'DAO',
                'path'          => null,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ];

        $level2  = $this->categoryRepository->findFirst('name', 'Logiciel');

        if(!empty($level2)) {
            foreach ($categoriesLevel3 as $level3) {
                $level3['parent_id'] = $level2->_id;
                $result = $this->categoryRepository->create($level3);
                $id = $result->_id;

                $data = [
                   'path'   => $level2->path . '/' . $id
                ];

                $this->categoryRepository->update($id, $data);
            }
        }
    }
}
