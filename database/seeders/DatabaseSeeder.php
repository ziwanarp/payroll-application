<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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

        \App\Models\Role::create([
            'role' => 'admin'
        ]);

        \App\Models\Role::create([
            'role' => 'user'
        ]);

        \App\Models\User::create([
            'name' => 'admin app',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'salary' => 0,
            'role_id' => 1,
            'last_login' => now(),
            'user_active' => true,
            'account_active' => true,
        ]);
    }
}
