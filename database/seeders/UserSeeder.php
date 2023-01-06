<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'type' => "USER",
                'name' => "User",
                'email' => "user@gmail.com",
                'password' => Hash::make('password'),
            ],
            [
                'type' => "ADMIN",
                'name' => "Admin",
                'email' => "admin@gmail.com",
                'password' => Hash::make('password'),
            ],
            [
                'type' => "STAFF",
                'name' => "Staff",
                'email' => "staff@gmail.com",
                'password' => Hash::make('password'),
            ],
        ]);
    }
}
