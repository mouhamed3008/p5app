<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\ArticleConfection;
use App\Models\Categorie;

class ArticleConfectionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ArticleConfection::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'libelle' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'quantiteStock' => $this->faker->numberBetween(-10000, 10000),
            'prix' => $this->faker->randomFloat(0, 0, 9999999999.),
            'reference' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'photo' => $this->faker->sha256,
            'categorie_id' => Categorie::factory(),
        ];
    }
}
