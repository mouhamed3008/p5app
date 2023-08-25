<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\ArticleConfection;
use App\Models\ArticleVente;
use App\Models\VenteConfection;

class VenteConfectionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VenteConfection::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'vente_id' => ArticleVente::factory(),
            'article_confection_id' => ArticleConfection::factory(),
        ];
    }
}
