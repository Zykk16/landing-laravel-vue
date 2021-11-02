<?php

namespace App\Http\Controllers;

use App\Models\Applications;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ApplicationsController extends Controller
{

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function index(Request $request): JsonResponse
    {
        $validated = $this->validate($request, [
            'categories' => 'nullable|array',
            'categories.*' => 'nullable|numeric|exists:application_categories,id',
            'sort' => 'required|in:created_at,category,name,phone,email,',
            'desc' => 'required|boolean',
            'created_at' => 'nullable|string',
            'name' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|string'
        ]);

        $applications = Applications::query();

        if (!empty($validated['categories'])) {
            $applications->whereIn('category', $validated['categories']);
        }
        if (!empty($validated['created_at'])) {
            $applications->where('created_at', 'like', '%' . $validated['created_at'] . '%');
        }
        if (!empty($validated['name'])) {
            $applications->where('name', 'like', '%' . $validated['name'] . '%');
        }

        $applications = $applications->orderBy($validated['sort'], $validated['desc'] ? 'desc' : 'asc');
        $applications = $applications->get();

        return response()->json($applications);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function submit(Request $request): JsonResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'message' => 'required',
        ]);

        Applications::create($request->all());

//        Mail::send('mail', array(
//            'name' => $request->get('name'),
//            'email' => $request->get('email'),
//            'user_query' => $request->get('message'),
//        ), function($message) use ($request){
//            $message->from($request->email);
//            $message->to('there email.com', 'Admin')->subject('новое письмо');
//        });

        return response()->json(null, 200);
    }
}
