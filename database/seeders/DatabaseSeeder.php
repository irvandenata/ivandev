<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        \App\Models\Role::create([
            'name' => 'superadmin',
        ]);
        \App\Models\Role::create([
            'name' => 'member',
        ]);
        \App\Models\User::create([
            'name' => 'Irvan Denata',
            'email' => 'irvandta@gmail.com',
            'username' => 'irvan-denata',
            'password' => Hash::make('password'),
            'role_id' => 1,
        ]);
    }
}
