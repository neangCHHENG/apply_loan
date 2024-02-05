<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Type_config extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            // Article
            // [
            //     'group_name'    => 'Article',
            //     'name'          => 'Single Article',
            //     'type'          => 'single_article',
            //     'description'   => 'Display single article as one page',
            //     'config_value'  => '{
            //                             "action":"selectArticle",
            //                             "referenceId":"id"
            //                         }',
            //     'state'         => 1,
            //     'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            //     'updated_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            // ],
            // [
            //     'group_name'    => 'Article',
            //     'name'          => 'Feature Article',
            //     'type'          => 'feature_article',
            //     'description'   => 'Display Feature Article as one page',
            //     'config_value'  => '',
            //     'state'         => 1,
            //     'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            //     'updated_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            // ],
            // [
            //     'group_name'    => 'Article',
            //     'name'          => 'Single Category',
            //     'type'          => 'single_category',
            //     'description'   => 'Display Single Category as one page',
            //     'config_value'  => '{
            //                             "action":"selectCategory",
            //                             "actionTitle":" Select category",
            //                             "referenceId":"id"
            //                         }',
            //     'state'         => 1,
            //     'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            //     'updated_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            // ],
            // [
            //     'group_name'    => 'Article',
            //     'name'          => 'Category List',
            //     'type'          => 'category_list',
            //     'description'   => 'Display Category List as one page',
            //     'config_value'  => '',
            //     'state'         => 1,
            //     'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            //     'updated_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            // ],

            // // Event
            // [
            //     'group_name'    => 'Events',
            //     'name'          => 'Event List',
            //     'type'          => 'event_list',
            //     'description'   => 'Display is Accordion as one page',
            //     'config_value'  => '',
            //     'state'         => 1,
            //     'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            //     'updated_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            // ],
            // [
            //     'group_name'    => 'Events',
            //     'name'          => 'Event Grid',
            //     'type'          => 'event_grid',
            //     'description'   => 'Display is Card as one page',
            //     'config_value'  => '',
            //     'state'         => 1,
            //     'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            //     'updated_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            // ],

            // Configuration
            [
                'group_name'    => 'Configuration',
                'name'          => 'External URL',
                'type'          => 'external_url',
                'description'   => 'Display External URL as one page',
                'config_value'  => '{
                                        "param1":"select",
                                        "param1List":[
                                            {
                                                "value":"external_url",
                                                "title":"External URL"
                                            }
                                        ]
                                    }',
                'state'         => 1,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'group_name'    => 'Configuration',
                'name'          => 'Change Language',
                'type'          => 'change_language',
                'description'   => 'Display Change Language as one page',
                'config_value'  => '{
                                        "khmer":{
                                            "font_icon":"kh",
                                            "file_icon":"http://10.15.60.21:8000/FrontEnd/Image/flag_khmer.png"
                                        },
                                        "english":{
                                            "font_icon":"en",
                                            "file_icon":"http://10.15.60.21:8000/FrontEnd/Image/flag_english.png"
                                        }
                                    }',
                'state'         => 1,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'group_name'    => 'Configuration',
                'name'          => 'Contact Form',
                'type'          => 'contact_form',
                'description'   => 'Display Contact Form as one page',
                'config_value'  => '',
                'state'         => 1,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'group_name'    => 'Configuration',
                'name'          => 'Main Page',
                'type'          => 'main_page',
                'description'   => 'Display Main Page as one page',
                'config_value'  => '',
                'state'         => 1,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'group_name'    => 'Configuration',
                'name'          => 'Job List',
                'type'          => 'job_list',
                'description'   => 'Display Job List as one page',
                'config_value'  => '',
                'state'         => 1,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            ],

        ];
        DB::table('type_configs')->insert($data);
    }
}
