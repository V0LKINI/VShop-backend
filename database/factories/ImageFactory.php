<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\Offer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Image::class;

    /**
     * Specify the folder for the image.
     *
     * @param  string $folder
     * @return $this
     */
    public function withFolder($folder)
    {
        $this->folder = $folder;

        return $this;
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image' => $this->folder . '/' . fake()->image('public/storage/' . $this->folder, 400, 400, null, false),
            'sort' => fake()->numberBetween(1, 1000),
        ];
    }
}
