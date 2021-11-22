<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoriesCasesResources;
use App\Models\CategoriesCases;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Str;

class CategoriesCasesController extends Controller
{
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
     * @return bool
     */
    public function store(Request $request, CategoriesCases $category)
    {
        $request->validate(['name' => ['required', 'string', 'min:3', 'max:255']]);
        $category->name = $request->name;

        return $category->save();
    }

    /**
     * @param Request $request
     * @param CategoriesCases $category
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $category = CategoriesCases::find($request->id);
        $category->update($request->all());

        return response()->json([
            'message' => 'Category Updated Successfully!!',
            'category' => $category
        ]);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        CategoriesCases::destroy($id);

        return response()->json(['Category delete'], 204);
    }
}
