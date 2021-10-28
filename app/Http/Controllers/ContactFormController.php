<?php

namespace App\Http\Controllers;

use App\Models\ContactForm;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ContactFormController extends Controller
{

    public function index(Request $request)
    {
        $validated = $this->validate($request, [
            'sort' => 'required|in:created_at,name',
            'desc' => 'required|boolean',
            'created_at' => 'nullable|string',
            'name' => 'nullable|string'
        ]);

        $applications = ContactForm::orderBy($validated['sort'], $validated['desc'] ? 'desc' : 'asc');

        if (!empty($validated['created_at'])) {
            $applications->where('created_at', 'like', '%' . $validated['created_at'] . '%');
        }
        if (!empty($validated['name'])) {
            $applications->where('name', 'like', '%' . $validated['name'] . '%');
        }

        return response()->json($applications->get());
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

        ContactForm::create($request->all());

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
