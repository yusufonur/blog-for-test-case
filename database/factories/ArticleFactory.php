<?php

namespace Database\Factories;

use Api\V1\Articles\Models\Article;
use Api\V1\Categories\Models\Category;
use Api\V1\Users\Models\User;
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

    public function randomCategory()
    {
        return $this->state(function (array $attributes) {
            return [
                'category_id' => Category::query()->inRandomOrder()->first(),
            ];
        });
    }

    public function writer(User $writer)
    {
        return $this->state(function (array $attributes) use ($writer) {
            return [
                'writer_id' => $writer,
            ];
        });
    }

    private function randomImagePath()
    {
        return $this->images[array_rand($this->images)];
    }
}
