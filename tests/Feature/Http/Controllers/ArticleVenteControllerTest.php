<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\ArticleVente;
use App\Models\Categorie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ArticleVenteController
 */
class ArticleVenteControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $articleVentes = ArticleVente::factory()->count(3)->create();

        $response = $this->get(route('article-vente.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ArticleVenteController::class,
            'store',
            \App\Http\Requests\ArticleVenteStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $libelle = $this->faker->word;
        $quantiteStock = $this->faker->numberBetween(-10000, 10000);
        $prix = $this->faker->randomFloat(/** float_attributes **/);
        $reference = $this->faker->word;
        $photo = $this->faker->sha256;
        $categorie = Categorie::factory()->create();

        $response = $this->post(route('article-vente.store'), [
            'libelle' => $libelle,
            'quantiteStock' => $quantiteStock,
            'prix' => $prix,
            'reference' => $reference,
            'photo' => $photo,
            'categorie_id' => $categorie->id,
        ]);

        $articleVentes = ArticleVente::query()
            ->where('libelle', $libelle)
            ->where('quantiteStock', $quantiteStock)
            ->where('prix', $prix)
            ->where('reference', $reference)
            ->where('photo', $photo)
            ->where('categorie_id', $categorie->id)
            ->get();
        $this->assertCount(1, $articleVentes);
        $articleVente = $articleVentes->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $articleVente = ArticleVente::factory()->create();

        $response = $this->get(route('article-vente.show', $articleVente));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ArticleVenteController::class,
            'update',
            \App\Http\Requests\ArticleVenteUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $articleVente = ArticleVente::factory()->create();
        $libelle = $this->faker->word;
        $quantiteStock = $this->faker->numberBetween(-10000, 10000);
        $prix = $this->faker->randomFloat(/** float_attributes **/);
        $reference = $this->faker->word;
        $photo = $this->faker->sha256;
        $categorie = Categorie::factory()->create();

        $response = $this->put(route('article-vente.update', $articleVente), [
            'libelle' => $libelle,
            'quantiteStock' => $quantiteStock,
            'prix' => $prix,
            'reference' => $reference,
            'photo' => $photo,
            'categorie_id' => $categorie->id,
        ]);

        $articleVente->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($libelle, $articleVente->libelle);
        $this->assertEquals($quantiteStock, $articleVente->quantiteStock);
        $this->assertEquals($prix, $articleVente->prix);
        $this->assertEquals($reference, $articleVente->reference);
        $this->assertEquals($photo, $articleVente->photo);
        $this->assertEquals($categorie->id, $articleVente->categorie_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $articleVente = ArticleVente::factory()->create();

        $response = $this->delete(route('article-vente.destroy', $articleVente));

        $response->assertNoContent();

        $this->assertModelMissing($articleVente);
    }
}
