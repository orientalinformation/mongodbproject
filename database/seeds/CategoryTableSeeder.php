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
        Category::truncate();

        // Categories for level 1
        $categoriesLevel1 = [
            [
                'parent_id'     => null,
                'name'          => 'Bois',
                'alias'         => 'bois',
                'description'   => 'Bois',
                'path'          => null,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'parent_id'     => null,
                'name'          => 'Pierre',
                'alias'         => 'pierre',
                'description'   => 'Pierre',
                'path'          => null,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ];

        $this->categoryRepository = app(CategoryRepositoryInterface::class);

        foreach ($categoriesLevel1 as $category) {
            $result = $this->categoryRepository->create($category);
            $id = $result->id;
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
                'alias'         => 'logiciel',
                'description'   => 'Logiciel',
                'path'          => null,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'parent_id'     => null,
                'name'          => 'Outil',
                'alias'         => 'outil',
                'description'   => 'Outil',
                'path'          => null,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'parent_id'     => null,
                'name'          => 'Règlementaires et normes',
                'alias'         => 'reglementaires-et-normes',
                'description'   => 'Règlementaires et normes',
                'path'          => null,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'parent_id'     => null,
                'name'          => 'Transition',
                'alias'         => 'transition',
                'description'   => 'Transition',
                'path'          => null,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'parent_id'     => null,
                'name'          => 'Matériaux',
                'alias'         => 'materiaux',
                'description'   => 'Matériaux',
                'path'          => null,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'parent_id'     => null,
                'name'          => 'Matériaux',
                'alias'         => 'materiaux',
                'description'   => 'Matériaux',
                'path'          => null,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'parent_id'     => null,
                'name'          => 'Produit',
                'alias'         => 'produit',
                'description'   => 'Produit',
                'path'          => null,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],


        ];

        $level1 = $this->categoryRepository->all();

        foreach ($level1 as $level) {
            foreach ($categoriesLevel2 as $level2) {
                $level2['parent_id'] = $level->id;
                $result = $this->categoryRepository->create($level2);
                $id = $result->id;

                $data = [
                    'path'  => $level->id . '/' . $id
                ];

                $this->categoryRepository->update($id, $data);

            }
        }

        //Categories for level 3
        $categoriesLevel3 = [
            [
                'parent_id'     => null,
                'name'          => 'CAO',
                'alias'         => 'cao',
                'description'   => 'CAO',
                'path'          => null,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'parent_id'     => null,
                'name'          => 'DAO',
                'alias'         => 'dao',
                'description'   => 'DAO',
                'path'          => null,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ];

        $level2  = $this->categoryRepository->findFirst('name', 'Logiciel');

        if(!empty($level2)) {
            foreach ($categoriesLevel3 as $level3) {
                $level3['parent_id'] = $level2->id;
                $result = $this->categoryRepository->create($level3);
                $id = $result->id;

                $data = [
                   'path'   => $level2->path . '/' . $id
                ];

                $this->categoryRepository->update($id, $data);
            }
        }
    }
}
