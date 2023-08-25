<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\ArticleConfection;
use App\Models\Vente;
use App\Models\VenteConfection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\VenteConfectionController
 */
class VenteConfectionControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $venteConfections = VenteConfection::factory()->count(3)->create();

        $response = $this->get(route('vente-confection.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\VenteConfectionController::class,
            'store',
            \App\Http\Requests\VenteConfectionStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $vente = Vente::factory()->create();
        $article_confection = ArticleConfection::factory()->create();

        $response = $this->post(route('vente-confection.store'), [
            'vente_id' => $vente->id,
            'article_confection_id' => $article_confection->id,
        ]);

        $venteConfections = VenteConfection::query()
            ->where('vente_id', $vente->id)
            ->where('article_confection_id', $article_confection->id)
            ->get();
        $this->assertCount(1, $venteConfections);
        $venteConfection = $venteConfections->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $venteConfection = VenteConfection::factory()->create();

        $response = $this->get(route('vente-confection.show', $venteConfection));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\VenteConfectionController::class,
            'update',
            \App\Http\Requests\VenteConfectionUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $venteConfection = VenteConfection::factory()->create();
        $vente = Vente::factory()->create();
        $article_confection = ArticleConfection::factory()->create();

        $response = $this->put(route('vente-confection.update', $venteConfection), [
            'vente_id' => $vente->id,
            'article_confection_id' => $article_confection->id,
        ]);

        $venteConfection->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($vente->id, $venteConfection->vente_id);
        $this->assertEquals($article_confection->id, $venteConfection->article_confection_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $venteConfection = VenteConfection::factory()->create();

        $response = $this->delete(route('vente-confection.destroy', $venteConfection));

        $response->assertNoContent();

        $this->assertModelMissing($venteConfection);
    }
}
