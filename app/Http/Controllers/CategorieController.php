<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategorieStoreRequest;
use App\Http\Requests\CategorieUpdateRequest;
use App\Http\Resources\CategorieResource;
use App\Http\Resources\CategoryCollection;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategorieController extends Controller
{
    public function index(Request $request)
    {
        $categories = Categorie::all();

        return new CategoryCollection($categories);
    }

    public function store(CategorieStoreRequest $request)
    {
        $categorie = Categorie::create($request->validated());

        return new CategorieResource($categorie);
    }

    public function show(Request $request, Categorie $categorie)
    {
        return new CategorieResource($categorie);
    }

    public function update(CategorieUpdateRequest $request, Categorie $categorie)
    {
        $categorie->update($request->validated());

        return new CategorieResource($categorie);
    }

    public function destroy(Request $request, Categorie $categorie)
    {
        $categorie->delete();

        return response()->noContent();
    }
}
