<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LibrariesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $libraries = [
            ['name' => 'Library 1', 'email' => 'library1@email.com', 'password' => Hash::make('password')],
            ['name' => 'Library 2', 'email' => 'library2@email.com', 'password' => Hash::make('password')],
            ['name' => 'Library 3', 'email' => 'library3@email.com', 'password' => Hash::make('password')],
        ];

        DB::table('libraries')->insert($libraries);
    }

}
