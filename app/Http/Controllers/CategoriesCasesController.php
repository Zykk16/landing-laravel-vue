<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoriesCasesResources;
use App\Models\CategoriesCases;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Str;

class CategoriesCasesController extends Controller
{
    public function __construct()
    {
        $this->middleware('api')->only(['store', 'update', 'destroy']);
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $categories = CategoriesCases::all();

        return CategoriesCasesResources::collection($categories);
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function store(Request $request): AnonymousResourceCollection
    {
        $request->validate(['names' => 'required']);
        $categoriesNames = explode(',', $request->get('names'));
        $categoriesSaved = CategoriesCases::register($categoriesNames);

        return CategoriesCasesResources::collection($categoriesSaved);
    }

    /**
     * @param Request $request
     * @param CategoriesCases $category
     * @return CategoriesCasesResources
     */
    public function update(Request $request, CategoriesCases $category): CategoriesCasesResources
    {
        $request->validate(["name" => "required|max:255"]);

        if ($request->name !== $category->name) {
            $request->validate(["name" => "unique:categories"]);
        }

        $category->update([
            "name" => $request->name,
        ]);

        return new CategoriesCasesResources($category);
    }

    /**
     * @param CategoriesCases $category
     * @return JsonResponse
     */
    public function destroy(CategoriesCases $category): JsonResponse
    {
        $category->delete();

        return response()->json([], 204);
    }
}
