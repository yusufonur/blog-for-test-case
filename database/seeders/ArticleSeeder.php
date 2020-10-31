<?php

namespace Database\Seeders;

use Api\V1\Users\Models\User;
use Illuminate\Database\Seeder;
use Api\V1\Articles\Models\Article;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $writes = User::query()
            ->role(config("role.writer"))
            ->get();

        $writes->each(function ($writer) {
            Article::factory(10)
                ->randomCategory()
                ->writer($writer)
                ->create();
        });
    }
}
