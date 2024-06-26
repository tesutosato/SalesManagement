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
        $productNames = ['水', 'リンゴジュース', 'オレンジジュース', 'レモンジュース', 'グレープジュース', 'ピーチジュース', 'パイナップルジュース'];
        $productName = $productNames[rand(0,count($productNames) -1)];
        return [
            'company_id' => $this->faker->numberBetween($min = 1, $max = 81),
            'product_name' => $this->faker->realText(20),
            'price' => $this->faker->numberBetween($min = 100, $max = 200),
            'stock' => $this->faker->numberBetween($min = 1, $max = 20),
            'comment' => $this->faker->realText(15),
            'img_path' => $this->faker->realText(50),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null,
        ];
    }
}
