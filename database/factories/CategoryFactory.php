<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'category_name_en' => $this->faker->unique->word,
            'category_name_ar' => $this->faker->unique->word,
            'category_slug_en' => $this->faker->slug,
            'category_slug_ar' => $this->faker->slug,
            'category_icon'   => $this->faker->sha1
        ];
    }
}
