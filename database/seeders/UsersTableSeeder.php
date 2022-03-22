<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = DB::table('users')->insert([
            'id' => 1,
            'full_name' => 'Jhay Castillo',
            'email' => 'example@gmail.com',
            'role_id' => 1,
            'password' => Hash::make('example123'),
        ]);
    }
}
