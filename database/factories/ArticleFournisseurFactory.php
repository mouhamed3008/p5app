<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\ArticleConfection;
use App\Models\ArticleFournisseur;
use App\Models\Fournisseur;

class ArticleFournisseurFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ArticleFournisseur::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'fournisseur_id' => Fournisseur::factory(),
            'article_confection_id' => ArticleConfection::factory(),
        ];
    }
}
