<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NVPModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\NVPModel::factory(5)->create();
    }
}