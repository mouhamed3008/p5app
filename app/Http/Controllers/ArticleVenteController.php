<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleVenteStoreRequest;
use App\Http\Requests\ArticleVenteUpdateRequest;
use App\Http\Resources\ArticleVenteCollection;
use App\Http\Resources\ArticleVenteResource;
use App\Models\ArticleVente;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ArticleVenteController extends Controller
{
    public function index(Request $request)
    {
        $articleVentes = ArticleVente::all();

        return new ArticleVenteCollection($articleVentes);
    }

    public function store(ArticleVenteStoreRequest $request)
    {
        $articleVente = ArticleVente::create($request->validated());

        return new ArticleVenteResource($articleVente);
    }

    public function show(Request $request, ArticleVente $articleVente)
    {
        return new ArticleVenteResource($articleVente);
    }

    public function update(ArticleVenteUpdateRequest $request, ArticleVente $articleVente)
    {
        $articleVente->update($request->validated());

        return new ArticleVenteResource($articleVente);
    }

    public function destroy(Request $request, ArticleVente $articleVente)
    {
        $articleVente->delete();

        return response()->noContent();
    }
}
