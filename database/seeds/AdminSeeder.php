<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        DB::table('admins')->insert([
            'name' => 'Kerem Karataş',
            'email' => 'keremkaratas420@gmail.com',
            'password' =>bcrypt('102030'),
        ]);
    }
}
