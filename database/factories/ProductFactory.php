<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition()
    {
        return [
            'brand_id' => \App\Models\Brand::all()->random()->id, // choose a random id from categories id,
            'category_id' => \App\Models\Category::all()->random()->id, // choose a random id from categories id,
            'subcategory_id' => \App\Models\Subcategory::all()->random()->id,
            'subsubcategory_id' => \App\Models\Subsubcategory::all()->random()->id,
            'product_name_en' => $this->faker->unique->word,
            'product_name_ar' => $this->faker->unique->word,
            'product_slug_en' => $this->faker->slug,
            'product_slug_ar' => $this->faker->slug,
            'product_code'  => $this->faker->sha1,
            'product_qty' => $this->faker->numberBetween(0, 500),
            'product_tags_en' => 'tag1, tag2, tag3',
            'product_tags_ar' => 'tag1, tag2, tag3',
            'product_size_en' => $this->faker->randomElement(['big', 'small', 'midum']),
            'product_size_ar' => $this->faker->randomElement(['big', 'small', 'midum']),
            'product_color_en' => $this->faker->randomElement(['blue', 'red', 'black']),
            'product_color_ar' => $this->faker->randomElement(['blue', 'red', 'black']),
            'selling_price' => $this->faker->numberBetween(10, 15000),
            'short_descp_en' => $this->faker->text,
            'short_descp_ar'  => $this->faker->text,
            'long_descp_en'  => $this->faker->text,
            'long_descp_ar'  => $this->faker->text,
            'product_thambnail'  => $this->faker->sha1,
        ];
    }
}
