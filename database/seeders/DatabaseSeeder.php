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

        \App\Models\Configuration::create([
            'variable' => 'time_in',
            'value' => '08:00:00',
        ]);

        \App\Models\Configuration::create([
            'variable' => 'time_out',
            'value' => '17:00:00',
        ]);

        \App\Models\Configuration::create([
            'variable' => 'office_location',
            'value' => '-6.214252843727726, 106.94931853768216',
        ]);

        \App\Models\Configuration::create([
            'variable' => 'deduction',
            'value' => '15000',
        ]);

        \App\Models\Configuration::create([
            'variable' => 'allowance',
            'value' => '30000',
        ]);

        \App\Models\User::create([
            'name' => 'admin app',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'salary' => 4500000,
            'role_id' => 1,
            'last_login' => now(),
            'user_active' => true,
            'account_active' => true,
            'ip_login' => '127.0.0.1'
        ]);
    }
}
