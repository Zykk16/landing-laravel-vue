<?php

namespace App\Http\Controllers;

use App\Models\Applications;
use App\Rules\Emails;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ApplicationsController extends Controller
{

    /**
     * @param Applications $applications
     * @return JsonResponse
     */
    public function index(Applications $applications): JsonResponse
    {
        return response()->json($applications->with('category')->get());
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
            'email' => ['required', 'string', 'min:3', 'max:255', new Emails()],
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'category' => 'required',
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
