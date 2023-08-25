<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\ArticleConfection;
use App\Models\Categorie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ArticleConfectionController
 */
class ArticleConfectionControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $articleConfections = ArticleConfection::factory()->count(3)->create();

        $response = $this->get(route('article-confection.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ArticleConfectionController::class,
            'store',
            \App\Http\Requests\ArticleConfectionStoreRequest::class
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

        $response = $this->post(route('article-confection.store'), [
            'libelle' => $libelle,
            'quantiteStock' => $quantiteStock,
            'prix' => $prix,
            'reference' => $reference,
            'photo' => $photo,
            'categorie_id' => $categorie->id,
        ]);

        $articleConfections = ArticleConfection::query()
            ->where('libelle', $libelle)
            ->where('quantiteStock', $quantiteStock)
            ->where('prix', $prix)
            ->where('reference', $reference)
            ->where('photo', $photo)
            ->where('categorie_id', $categorie->id)
            ->get();
        $this->assertCount(1, $articleConfections);
        $articleConfection = $articleConfections->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $articleConfection = ArticleConfection::factory()->create();

        $response = $this->get(route('article-confection.show', $articleConfection));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ArticleConfectionController::class,
            'update',
            \App\Http\Requests\ArticleConfectionUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $articleConfection = ArticleConfection::factory()->create();
        $libelle = $this->faker->word;
        $quantiteStock = $this->faker->numberBetween(-10000, 10000);
        $prix = $this->faker->randomFloat(/** float_attributes **/);
        $reference = $this->faker->word;
        $photo = $this->faker->sha256;
        $categorie = Categorie::factory()->create();

        $response = $this->put(route('article-confection.update', $articleConfection), [
            'libelle' => $libelle,
            'quantiteStock' => $quantiteStock,
            'prix' => $prix,
            'reference' => $reference,
            'photo' => $photo,
            'categorie_id' => $categorie->id,
        ]);

        $articleConfection->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($libelle, $articleConfection->libelle);
        $this->assertEquals($quantiteStock, $articleConfection->quantiteStock);
        $this->assertEquals($prix, $articleConfection->prix);
        $this->assertEquals($reference, $articleConfection->reference);
        $this->assertEquals($photo, $articleConfection->photo);
        $this->assertEquals($categorie->id, $articleConfection->categorie_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $articleConfection = ArticleConfection::factory()->create();

        $response = $this->delete(route('article-confection.destroy', $articleConfection));

        $response->assertNoContent();

        $this->assertModelMissing($articleConfection);
    }
}
