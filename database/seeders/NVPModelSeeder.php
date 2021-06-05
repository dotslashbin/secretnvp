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
        // Populates the a whole bunch of records
        \App\Models\NVPModel::factory(1000)->create();
        \App\Models\NVPModel::factory(5)->create(['key' => 'FOO']);
    }
}
