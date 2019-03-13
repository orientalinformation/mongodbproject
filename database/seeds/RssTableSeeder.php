<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Model\Rss;

class RssTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rss::truncate();
        $data = [
            [
                'rss'           => 'https://vnexpress.net/rss/tin-tuc.rss',
                'description'   => 'Tin tuc',
                'userId'        => 1,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'rss'           => 'https://vnexpress.net/rss/am-thuc.rss',
                'description'   => 'Am thuc',
                'userId'        => 1,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'rss'           => 'https://vnexpress.net/rss/luat-phap.rss',
                'description'   => 'Luat phap',
                'userId'        => 1,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'rss'           => 'https://vnexpress.net/rss/thoi-su.rss',
                'description'   => 'Thoi su',
                'userId'        => 1,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'rss'           => 'https://vnexpress.net/rss/cong-nghe.rss',
                'description'   => 'Cong nghe',
                'userId'        => 1,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'rss'           => 'https://vnexpress.net/rss/quang-cao.rss',
                'description'   => 'Quang cao',
                'userId'        => 2,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'rss'           => 'https://vnexpress.net/rss/thoi-su-trong-nuoc.rss',
                'description'   => 'Thoi su trong nuoc',
                'userId'        => 2,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'rss'           => 'https://vnexpress.net/rss/thoi-su-quoc-te.rss',
                'description'   => 'Thoi su quoc te',
                'userId'        => 2,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'rss'           => 'https://vnexpress.net/rss/thoi-trang.rss',
                'description'   => 'Thoi trang',
                'userId'        => 2,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'rss'           => 'https://vnexpress.net/rss/the-thao.rss',
                'description'   => 'The thao',
                'userId'        => '3',
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
