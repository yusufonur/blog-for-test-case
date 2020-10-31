<?php

namespace Database\Factories;

use Api\V1\Articles\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    public $images = [
        "image-1.jpg",
        "image-2.jpg",
        "image-3.jpg",
        "image-4.jpg",
        "image-5.jpg",
    ];

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "title" => $this->faker->text(20),
            "slug" => null,
            "cover_image" => $this->randomImagePath(),
            "content" => $this->faker->paragraph,
            "category_id" => null,
            "writer_id" => null
        ];
    }

    private function randomImagePath()
    {
        return $this->images[array_rand($this->images)];
    }
}
