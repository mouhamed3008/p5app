<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleConfectionStoreRequest;
use App\Http\Requests\ArticleConfectionUpdateRequest;
use App\Http\Resources\ArticleConfectionCollection;
use App\Http\Resources\ArticleConfectionResource;
use App\Models\ArticleConfection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ArticleConfectionController extends Controller
{
    public function index(Request $request)
    {
        $articleConfections = ArticleConfection::all();

        return new ArticleConfectionCollection($articleConfections);
    }

    public function store(ArticleConfectionStoreRequest $request)
    {
        $articleConfection = ArticleConfection::create($request->validated());

        return new ArticleConfectionResource($articleConfection);
    }

    public function show(Request $request, ArticleConfection $articleConfection)
    {
        return new ArticleConfectionResource($articleConfection);
    }

    public function update(ArticleConfectionUpdateRequest $request, ArticleConfection $articleConfection)
    {
        $articleConfection->update($request->validated());

        return new ArticleConfectionResource($articleConfection);
    }

    public function destroy(Request $request, ArticleConfection $articleConfection)
    {
        $articleConfection->delete();

        return response()->noContent();
    }
}
