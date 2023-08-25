<?php

namespace Database\Seeders;

use App\Models\FournisseurCategorieArticleConfectionVenteConfectionArticleVente;
use Illuminate\Database\Seeder;

class FournisseurCategorieArticleConfectionVenteConfectionArticleVenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FournisseurCategorieArticleConfectionVenteConfectionArticleVente::factory()->count(5)->create();
    }
}
