<?php

namespace App\Http\Controllers;

use App\Http\Requests\FournisseurStoreRequest;
use App\Http\Requests\FournisseurUpdateRequest;
use App\Http\Resources\FournisseurCollection;
use App\Http\Resources\FournisseurResource;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FournisseurController extends Controller
{
    public function index(Request $request)
    {
        $fournisseurs = Fournisseur::all();

        return new FournisseurCollection($fournisseurs);
    }

    public function store(FournisseurStoreRequest $request)
    {
        $fournisseur = Fournisseur::create($request->validated());

        return new FournisseurResource($fournisseur);
    }

    public function show(Request $request, Fournisseur $fournisseur)
    {
        return new FournisseurResource($fournisseur);
    }

    public function update(FournisseurUpdateRequest $request, Fournisseur $fournisseur)
    {
        $fournisseur->update($request->validated());

        return new FournisseurResource($fournisseur);
    }

    public function destroy(Request $request, Fournisseur $fournisseur)
    {
        $fournisseur->delete();

        return response()->noContent();
    }
}
