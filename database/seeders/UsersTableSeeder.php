<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Generate and insert 100 users
        for ($i = 1; $i <= 10; $i++) {
            DB::table('users')->insert([
                'name' => 'User' . $i,
                'email' => 'user' . $i . '@example.com',
                'password' => bcrypt('password'), // Use a secure password hashing method
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
