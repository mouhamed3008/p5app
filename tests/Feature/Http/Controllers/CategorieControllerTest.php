<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\CategorieController
 */
class CategorieControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $categories = Categorie::factory()->count(3)->create();

        $response = $this->get(route('categorie.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CategorieController::class,
            'store',
            \App\Http\Requests\CategorieStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $libelle = $this->faker->word;
        $type = $this->faker->word;

        $response = $this->post(route('categorie.store'), [
            'libelle' => $libelle,
            'type' => $type,
        ]);

        $categories = Categorie::query()
            ->where('libelle', $libelle)
            ->where('type', $type)
            ->get();
        $this->assertCount(1, $categories);
        $categorie = $categories->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $categorie = Categorie::factory()->create();

        $response = $this->get(route('categorie.show', $categorie));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CategorieController::class,
            'update',
            \App\Http\Requests\CategorieUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $categorie = Categorie::factory()->create();
        $libelle = $this->faker->word;
        $type = $this->faker->word;

        $response = $this->put(route('categorie.update', $categorie), [
            'libelle' => $libelle,
            'type' => $type,
        ]);

        $categorie->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($libelle, $categorie->libelle);
        $this->assertEquals($type, $categorie->type);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $categorie = Categorie::factory()->create();

        $response = $this->delete(route('categorie.destroy', $categorie));

        $response->assertNoContent();

        $this->assertModelMissing($categorie);
    }
}
