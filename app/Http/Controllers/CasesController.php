<?php

namespace App\Http\Controllers;

use App\Http\Requests\CasesRequest;
use App\Http\Resources\CasesCollection;
use App\Http\Resources\CasesResources;
use App\Models\Cases;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CasesController extends Controller
{
    /**
     * @return CasesCollection
     */
    public function index(): CasesCollection
    {
        return new CasesCollection(Cases::all());
    }

    public function frontendCases(): JsonResponse
    {
        $cases = Cases::with('category')->where('status_id', 1)
            ->orderBy('created_at', 'DESC')->get();

        return response()->json($cases);
    }

    /**
     * @param CasesRequest $request
     * @return CasesResources
     */
    public function store(CasesRequest $request): CasesResources
    {
        $data = $request->data();

        if (!is_string($data['image'])) {
            $data['image'] = $this->uploadImage($request->file('image'));
        }

        $data['slug'] = Str::slug($data['title']);
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

        $case->slug = Str::slug($case->title);
        $case->updated_at = Carbon::now();
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

    /**
     * @param Cases $case
     * @return JsonResponse
     */
    public function show($case): JsonResponse
    {
        preg_match('/-([0-9]+)$/', $case, $result);
        $id = $result[1];

        $data = Cases::with('category')->where('id', $id)->get();
        return response()->json($data[0]);
    }
}
