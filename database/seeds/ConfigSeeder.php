<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigSeeder extends Seeder
{
    public function run()
    {
        DB::table('configs')->insert([
            'title' => 'keremkaratas.com',
            'created_at'=>now(),
            'updated_at'=>now()
        ]);
    }
}
