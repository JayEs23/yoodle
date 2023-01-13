<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = [
            ['title' => 'Book 1', 'author' => 'Author 1', 'library_id' => 1, 'ISBN' => '1234567890'],
            ['title' => 'Book 2', 'author' => 'Author 2', 'library_id' => 2, 'ISBN' => '0987654321'],
            ['title' => 'Book 3', 'author' => 'Author 3', 'library_id' => 3, 'ISBN' => '1011121314'],
        ];

        DB::table('books')->insert($books);
    }

}
