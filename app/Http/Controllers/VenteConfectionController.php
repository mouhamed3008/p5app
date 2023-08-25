<?php

namespace App\Http\Controllers;

use App\Http\Requests\VenteConfectionStoreRequest;
use App\Http\Requests\VenteConfectionUpdateRequest;
use App\Http\Resources\VenteConfectionCollection;
use App\Http\Resources\VenteConfectionResource;
use App\Models\VenteConfection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VenteConfectionController extends Controller
{
    public function index(Request $request)
    {
        $venteConfections = VenteConfection::all();

        return new VenteConfectionCollection($venteConfections);
    }

    public function store(VenteConfectionStoreRequest $request)
    {
        $venteConfection = VenteConfection::create($request->validated());

        return new VenteConfectionResource($venteConfection);
    }

    public function show(Request $request, VenteConfection $venteConfection)
    {
        return new VenteConfectionResource($venteConfection);
    }

    public function update(VenteConfectionUpdateRequest $request, VenteConfection $venteConfection)
    {
        $venteConfection->update($request->validated());

        return new VenteConfectionResource($venteConfection);
    }

    public function destroy(Request $request, VenteConfection $venteConfection)
    {
        $venteConfection->delete();

        return response()->noContent();
    }
}
