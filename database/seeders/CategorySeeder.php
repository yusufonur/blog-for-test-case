<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Api\V1\Categories\Models\Category;

class CategorySeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory(10)
            ->create();
    }
}
