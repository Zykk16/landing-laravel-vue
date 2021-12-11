<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name'      => 'required|min:3|max:50',
            'email'     => 'required|email|unique:users'
        ];

        if ($this->method() == "POST") {
            $rules["password"] = ["required", "min:8"];
        }

        if ($this->method() == "PUT") {
            $rules["name"] = ["nullable"];
            $rules["email"] = ["nullable"];
        }

        return $rules;
    }

    public function data(): array
    {
        return $this->only([
            'name',
            'email'
        ]);
    }

    public function messages()
    {
        return [
            'name.required'     => 'Необходимо заполнить',
            'email.required'    => 'Необходимо заполнить'
        ];
    }
}
