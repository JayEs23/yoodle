<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        $users = [
            ['name' => 'User 1', 'email' => 'user1@email.com', 'password' => Hash::make('password'), 'library_id' => 1],
            ['name' => 'User 2', 'email' => 'user2@email.com', 'password' => Hash::make('password'), 'library_id' => 2],
            ['name' => 'User 3', 'email' => 'user3@email.com', 'password' => Hash::make('password'), 'library_id' => 3],
        ];

        DB::table('users')->insert($users);
    }

}
