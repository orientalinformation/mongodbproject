<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Model\Rss;
use App\Model\Web;
use Elasticsearch\ClientBuilder;

class RssTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rss::query()->delete();
        Web::query()->delete();
        //delete ElasticSearch Web Index
        $param = [
            'index' => Config::get('constants.elasticsearch.web.index')
        ];

        $client = ClientBuilder::create()->build();
        // check index exists before delete
        if ($client->indices()->exists($param)) {
            $client->indices()->delete($param);
        }

        $data = [
            [
                'url'           => 'https://www.lemonde.fr/rss/une.xml',
                'description'   => 'A la une',
                'user_id'        => 1,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'url'           => 'https://www.lemonde.fr/videos/rss_full.xml',
                'description'   => 'Les vidéos',
                'user_id'        => 1,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'url'           => 'https://www.lemonde.fr/m-actu/rss_full.xml',
                'description'   => 'Actu',
                'user_id'        => 1,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'url'           => 'https://www.lemonde.fr/afrique/rss_full.xml',
                'description'   => 'Afrique',
                'user_id'        => 1,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'url'           => 'https://www.lemonde.fr/ameriques/rss_full.xml',
                'description'   => 'Amériques',
                'user_id'        => 1,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'url'           => 'https://www.lemonde.fr/argent/rss_full.xml',
                'description'   => 'Argent & Placements',
                'user_id'        => 2,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'url'           => 'https://www.lemonde.fr/asie-pacifique/rss_full.xml',
                'description'   => 'Asie-Pacifique',
                'user_id'        => 2,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'url'           => 'https://www.lemonde.fr/attentat-de-manchester/rss_full.xml',
                'description'   => 'Attentat de Manchester',
                'user_id'        => 2,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'url'           => 'https://www.lemonde.fr/bac-lycee/rss_full.xml',
                'description'   => 'Bac',
                'user_id'        => 2,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'url'           => 'https://www.lemonde.fr/bachelor/rss_full.xml',
                'description'   => 'Bachelor',
                'user_id'        => '3',
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ];

        foreach ($data as $item) {
            $rss = new Rss();

            $rss->create($item);
        }

    }
}
