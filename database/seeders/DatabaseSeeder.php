<?php

namespace Database\Seeders;

use App\Models\Library;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(LibrariesTableSeeder::class);
        $this->call(BooksTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        
        $superAdmin = Library::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => bcrypt('password'),
        ]);
        $adminRole = Role::create([
            'name' => 'admin',
        ]);
        $superAdminUser = User::create([
            'name' => 'Super Admin User',
            'email' => 'superadminuser@example.com',
            'password' => bcrypt('password'),
            'library_id' => $superAdmin->id,
        ]);
        $superAdminUser->roles()->attach($adminRole);
    }
}
