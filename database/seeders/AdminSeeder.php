<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash; //this would facilitate hashing function in password

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $obj = new Admin();
        $obj->name = 'Emperor';
        $obj->email = 'mohammad.hafiz_hersyah.mc4@is.naist.jp';
        $obj->password = Hash::make('emperor123');
        $obj->save();
    }
}