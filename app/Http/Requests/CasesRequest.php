<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CasesRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        $this->reformatData();

        $rules = [
            'title' => 'required|max:200',
            'category_id' => 'required|exists:categories_cases,id',
            'logo' => ['nullable'],
        ];

        if ($this->method() == 'POST') {
            $rules['logo'][0] = ['required', 'img'];
        }

        if ($this->method() === 'PUT' && $this->image !== null) {
            $rules['logo'][] = 'img';
        }

        return $rules;
    }

    /**
     * @return array
     */
    public function data(): array
    {
        return $this->only(['title', 'category_id']);
    }

    private function reformatData(): void
    {
        if ($this->logo === 'null') {
            $this->merge(['logo' => null]);
        }
    }
}