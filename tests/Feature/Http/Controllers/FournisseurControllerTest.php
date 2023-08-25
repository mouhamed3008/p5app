<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Fournisseur;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\FournisseurController
 */
class FournisseurControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $fournisseurs = Fournisseur::factory()->count(3)->create();

        $response = $this->get(route('fournisseur.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\FournisseurController::class,
            'store',
            \App\Http\Requests\FournisseurStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $libelle = $this->faker->word;

        $response = $this->post(route('fournisseur.store'), [
            'libelle' => $libelle,
        ]);

        $fournisseurs = Fournisseur::query()
            ->where('libelle', $libelle)
            ->get();
        $this->assertCount(1, $fournisseurs);
        $fournisseur = $fournisseurs->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $fournisseur = Fournisseur::factory()->create();

        $response = $this->get(route('fournisseur.show', $fournisseur));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\FournisseurController::class,
            'update',
            \App\Http\Requests\FournisseurUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $fournisseur = Fournisseur::factory()->create();
        $libelle = $this->faker->word;

        $response = $this->put(route('fournisseur.update', $fournisseur), [
            'libelle' => $libelle,
        ]);

        $fournisseur->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($libelle, $fournisseur->libelle);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $fournisseur = Fournisseur::factory()->create();

        $response = $this->delete(route('fournisseur.destroy', $fournisseur));

        $response->assertNoContent();

        $this->assertModelMissing($fournisseur);
    }
}
