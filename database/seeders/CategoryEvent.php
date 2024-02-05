<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategoryEvent extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name_kh'           => 'បញ្ជីព្រឹត្តិការណ៍',
                'name_en'           => 'Event List',
                'slug'              => 'event-list',
                'description_kh'    => 'Event List',
                'description_en'    => 'Event List',
                'note'              => 'Display list event single page by event',
                'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name_kh'           => 'ក្រឡាចត្រង្គព្រឹត្តិការណ៍',
                'name_en'           => 'Event Grid',
                'slug'              => 'event-grid',
                'description_kh'    => 'Event Grid',
                'description_en'    => 'Event Grid',
                'note'              => 'Display Grid event single page by event',
                'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];
        DB::table('category_events')->insert($data);
    }
}
