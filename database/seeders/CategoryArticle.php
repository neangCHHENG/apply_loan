<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategoryArticle extends Seeder
{
    public function run()
    {
        var_dump(Carbon::now()->toTimeString());
        $data = [
            // [
            //     'name_kh'           => 'អត្ថបទពិសេស',
            //     'name_en'           => 'Featured Articles',
            //     'slug'              => 'featured-articles',
            //     'description_kh'    => 'អត្ថបទពិសេស',
            //     'description_en'    => 'Article Category',
            //     'note'              => 'Article Category',
            //     'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            //     'updated_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            // ],
            [
                'name_kh'           => 'អត្ថបទតែមួយ',
                'name_en'           => 'Single Articles',
                'slug'              => 'single-articles',
                'description_kh'    => 'អត្ថបទតែមួយ',
                'description_en'    => 'Article Category',
                'note'              => 'Article Category',
                'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name_kh'           => 'ប្រភេទអត្ថបទ',
                'name_en'           => 'Category Articles',
                'slug'              => 'category-articles',
                'description_kh'    => 'ប្រភេទអត្ថបទ',
                'description_en'    => 'Article Category',
                'note'              => 'Article Category',
                'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            // [
            //     'name_kh'           => 'បញ្ជីប្រភេទអត្ថបទ',
            //     'name_en'           => 'Category List Articles',
            //     'slug'              => 'category-list-articles',
            //     'description_kh'    => 'បញ្ជីប្រភេទអត្ថបទ',
            //     'description_en'    => 'Article Category',
            //     'note'              => 'Article Category',
            //     'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            //     'updated_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            // ],
            // [
            //     'name_kh'           => 'អត្ថបទទម្រង់ទំនាក់ទំនង',
            //     'name_en'           => 'Contact Form Articles',
            //     'slug'              => 'contact-form-articles',
            //     'description_kh'    => 'អត្ថបទទម្រង់ទំនាក់ទំនង',
            //     'description_en'    => 'Article Category',
            //     'note'              => 'Article Category',
            //     'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            //     'updated_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            // ],
            // [
            //     'name_kh'           => 'អត្ថបទភាសាចាង',
            //     'name_en'           => 'Chang Language Articles',
            //     'slug'              => 'change-language-articles',
            //     'description_kh'    => 'អត្ថបទភាសាចាង',
            //     'description_en'    => 'Article Category',
            //     'note'              => 'Article Category',
            //     'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            //     'updated_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            // ],
            // [
            //     'name_kh'           => 'អត្ថបទ URL ខាងក្រៅ',
            //     'name_en'           => 'External URL Articles',
            //     'slug'              => 'external-url-articles',
            //     'description_kh'    => 'អត្ថបទ URL ខាងក្រៅ',
            //     'description_en'    => 'Article Category',
            //     'note'              => 'Article Category',
            //     'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            //     'updated_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            // ],
            // [
            //     'name_kh'           => 'ទំព័រដើមអត្ថបទ',
            //     'name_en'           => 'Main Page Articles',
            //     'slug'              => 'main-page-articles',
            //     'description_kh'    => 'ទំព័រដើមអត្ថបទ',
            //     'description_en'    => 'Article Category',
            //     'note'              => 'Article Category',
            //     'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            //     'updated_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            // ],
            [
                'name_kh'           => 'ព័ត៌មាន',
                'name_en'           => 'News',
                'slug'              => 'News',
                'description_kh'    => 'ព័ត៌មាន',
                'description_en'    => 'Article Category',
                'note'              => 'Article Category',
                'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];
        DB::table('category_articles')->insert($data);
    }
}
