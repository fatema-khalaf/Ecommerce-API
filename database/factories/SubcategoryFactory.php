<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subcategory>
 */
class SubcategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
        'category_id' => \App\Models\Category::all()->random()->id, // choose a random id from categories id
        'subcategory_name_en' => $this->faker->unique->word,
        'subcategory_name_ar' => $this->faker->unique->word,
        'subcategory_slug_en' => $this->faker->slug,
        'subcategory_slug_ar' => $this->faker->slug,
        ];
    }
}
