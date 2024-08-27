<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            //admin
            [
                'name' => 'Emperor',
                'username' => 'admin007',
                'email' => 'mohammad.hafiz_hersyah.mc4@is.naist.jp',
                'password' => Hash::make('007'),
                'role' => 'admin',
                'status' => 'active',
            ],
            [
                'name' => 'User',
                'username' => 'user',
                'email' => 'user@gmail.com',
                'password' => Hash::make('007'),
                'role' => 'user',
                'status' => 'active',
            ],
        ]);
    }
}
