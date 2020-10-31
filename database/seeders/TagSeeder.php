<?php

namespace Database\Seeders;

use Api\V1\Articles\Models\Article;
use Api\V1\Categories\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class TagSeeder extends Seeder
{
    /**
     * @var \Faker\Generator
     */
    private $faker;

    public function __construct()
    {
        $this->faker = Faker::create();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::all();

        $articles = Article::all();

        $categories->each(function ($category) {
            $this->appendTags($category);
        });

        $articles->each(function ($article) {
            $this->appendTags($article);
        });
    }

    private function appendTags(Model $model)
    {
        return $model->tag(
            $this->faker->words(3)
        );
    }

}
