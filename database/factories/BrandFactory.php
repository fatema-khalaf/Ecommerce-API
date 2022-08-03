<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'brand_name_en' => $this->faker->company,
            'brand_name_ar' => $this->faker->company,
            'brand_slug_en' => $this->faker->slug,
            'brand_slug_ar' => $this->faker->slug,
            'brand_image'   => '/upload/brands/17401382410466511740138241046653.jpg'
        ];
    }
}
