<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    public function run()
    {
        $count = 0;
        $pages = ['Hakkımızda', 'Kariyer', 'Reklam', 'Telif Hakkı'];
        foreach ($pages as $page) {
            $count++;
            DB::table('pages')->insert([
                'title' => $page,
                'slug' => Str::slug($page),
                'image' => 'https://image.shutterstock.com/image-photo/portrait-surprised-cat-scottish-straight-260nw-499196506.jpg',
                'content' => 'mi quis hendrerit dolor magna eget est lorem ipsum dolor sit amet consectetur ' .
                    'adipiscing elit pellentesque ' .
                    'habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas integer eget',
                'order' => $count,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
