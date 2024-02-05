<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Menu extends Seeder
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
                'menu_en'       => 'Main Menu',
                'slug'          => 'main-menu',
                'menu_kh'       => 'មីនុយមេ',
                'parent_id'     =>  0,
                'link'          => 'javascript:;',
                'reference_id'  =>  0,
                'menu_type'     => 'Main',
                'type'          => 'Main Menu',
                'position'      => 'Main',
                'is_root'       =>   1,
                'created_by'    =>  'admin',
                'updated_by'    =>  'admin',

                // 'param1'        => 'param1',
                // 'param2'        => 'param2',
                'left'          =>  1,
                'right'         =>  2,
                // 'level'         =>  0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];
        DB::table('menus')->insert($data);
    }
}
