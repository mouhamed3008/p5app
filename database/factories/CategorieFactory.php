<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Categorie;

class CategorieFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Categorie::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'libelle' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'type' => $this->faker->regexify('[A-Za-z0-9]{255}'),
        ];
    }
}
