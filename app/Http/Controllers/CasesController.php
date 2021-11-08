<?php

namespace App\Http\Controllers;

use App\Http\Requests\CasesRequest;
use App\Http\Resources\CasesCollection;
use App\Http\Resources\CasesResources;
use App\Models\Cases;
use Illuminate\Http\Request;
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
        $data["image"] = $this->uploadCover($request->file("logo"));
        $post = Cases::create($data);

        return new CasesResources($post);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * @param CasesRequest $request
     * @param Cases $cases
     * @return CasesResources
     */
    public function update(CasesRequest $request, Cases $cases): CasesResources
    {
        $data = $request->data();

        if ($request->file('logo')) {
            Storage::delete("public/update/" . $cases->logo);
            $data["image"] = $this->uploadCover($request->file('logo'));
        }

        $cases->update($data);

        return new CasesResources($cases);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function uploadCover(UploadedFile $file): string
    {
        $filename = time() . "_" . $file->getClientOriginalName();
        $file->storeAs('uploads', $filename, 'public');

        return asset("storage/uploads/" . $filename);
    }
}
