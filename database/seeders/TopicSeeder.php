<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('topics')->insert([
            [
                'title' => "Authentication",
            ],
            [
                'title' => "UI",
            ],
            [
                'title' => "Cart",
            ],
            [
                'title' => "Payment",
            ],
        ]);
    }
}
