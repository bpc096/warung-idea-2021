<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'category_name' => 'Art & Creativity',
            'category_slug' => 'art-and-creativity',
            'category_image' => 'https://images.unsplash.com/photo-1460661419201-fd4cecdf8a8b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1480&q=80'
        ]);

        DB::table('categories')->insert([
            'category_name' => 'Technology',
            'category_slug' => 'technology',
            'category_image' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=2340&q=80'
        ]);

        DB::table('categories')->insert([
            'category_name' => 'Games',
            'category_slug' => 'games',
            'category_image' => 'https://images.unsplash.com/photo-1493711662062-fa541adb3fc8?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80'
        ]);

        DB::table('categories')->insert([
            'category_name' => 'Books',
            'category_slug' => 'books',
            'category_image' => 'https://images.unsplash.com/photo-1495446815901-a7297e633e8d?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=2340&q=80'
        ]);

        DB::table('categories')->insert([
            'category_name' => 'Music',
            'category_slug' => 'music',
            'category_image' => 'https://images.unsplash.com/photo-1468164016595-6108e4c60c8b?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=2340&q=80'
        ]);

        DB::table('categories')->insert([
            'category_name' => 'Health & Fitness',
            'category_slug' => 'health-and-fitness',
            'category_image' => 'https://images.unsplash.com/photo-1517836357463-d25dfeac3438?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80'
        ]);
    }
}
