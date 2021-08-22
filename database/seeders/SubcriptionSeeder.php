<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Subcription;

class SubcriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Subcription::factory(1000)->create();
    }
}
