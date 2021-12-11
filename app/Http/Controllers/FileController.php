<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrUpdateRequest;
use App\Models\FileUpload;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * @param StoreOrUpdateRequest $request
     * @return JsonResponse|void
     */
    public function upload(StoreOrUpdateRequest $request)
    {
        $request->validated();

        $fileUpload = new FileUpload;

        if ($request->file()) {
            $file_name = time() . '_' . $request->file->getClientOriginalName();
            $file_path = $request->file('file')->storeAs('uploads', $file_name, 'public');

            $fileUpload->name = time() . '_' . $request->file->getClientOriginalName();
            $fileUpload->path = '/storage/' . $file_path;
            $fileUpload->category = $request->category;
            $fileUpload->save();

            return response()->json(['success' => 'File uploaded successfully.']);
        }
    }

    /**
     * @param FileUpload $fileUpload
     * @param StoreOrUpdateRequest $request
     * @return JsonResponse
     */
    public function updateOrderClients(Request $request): JsonResponse
    {
        $fileUpload = FileUpload::find($request->id);
        $fileUpload->order = $request->order;
        $fileUpload->save();

        return response()->json(['success' => 'Image update']);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        FileUpload::destroy($id);

        return response()->json(['message' => 'Images delete']);
    }
}
