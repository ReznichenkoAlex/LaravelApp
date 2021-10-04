<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'category_id' => mt_rand(1,5),
            'price' => mt_rand(500, 1999),
            'image' => '/img/cover/game-' . mt_rand(1, 9) . '.jpg',
            'description' => $this->faker->text()
        ];
    }
}
