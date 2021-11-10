<?php

namespace App\Http\Controllers;

use App\Http\Requests\CasesRequest;
use App\Http\Resources\CasesCollection;
use App\Http\Resources\CasesResources;
use App\Models\Cases;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CasesController extends Controller
{
    public function __construct()
    {
        $this->middleware("api")->only(["store", "update", "destroy"]);
    }

    /**
     * @return CasesCollection
     */
    public function index(): CasesCollection
    {
        return new CasesCollection(Cases::all());
    }

    /**
     * @param CasesRequest $request
     * @return CasesResources
     */
    public function store(CasesRequest $request): CasesResources
    {
        $data = $request->data();

        $data["image"] = $this->uploadImage($request->file("image"));

        $case = Cases::create($data);

        return new CasesResources($case);
    }

    /**
     * @param CasesRequest $request
     * @param Cases $case
     * @return CasesResources
     */
    public function update(CasesRequest $request, Cases $case): CasesResources
    {
        $data = $request->data();

        if ($request->file('image')) {
            Storage::delete('public/uploads/' . $case->image);

            $data['image'] = $this->uploadImage($request->file('image'));
        }

        $case->update($data);

        return new CasesResources($case);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Cases $case
     * @return JsonResponse
     */
    public function destroy(Cases $case): JsonResponse
    {
        $case->delete();

        Storage::delete('public/uploads/' . $case->image);

        return response()->json(['Case delete'], 204);
    }

    private function uploadImage(UploadedFile $file): string
    {
        $filename = time() . "_" . $file->getClientOriginalName();
        $file->storeAs('uploads', $filename, 'public');

        return asset("storage/uploads/" . $filename);
    }
}
