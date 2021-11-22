<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrUpdatePositionRequest extends FormRequest
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
        return [
            'file' => 'required|mimes:jpg,jpeg,png,svg|max:2048',
            'category' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'Прежде чем отправить изображение, необходимо его добавить',
            'file.mimes' => 'Поддерживает форматы - jpg,jpeg,png,svg'
        ];
    }
}
