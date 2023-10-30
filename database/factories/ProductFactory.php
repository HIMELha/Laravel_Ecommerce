<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->name();
        $slug = Str::slug($title);
        

        return [
            'title' => $title,
            'slug' => $slug,
            'category_id' => rand(170,172),
            'brand_id' => rand(35,37),
            'price' => rand(10,10000),
            'sku' => rand(1000,200000),
            'track_qty' => 'Yes',
            'qty' => rand(10,1000),
            'status' => 1
        ];
    }
}
