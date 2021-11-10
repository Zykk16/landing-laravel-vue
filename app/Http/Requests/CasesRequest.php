<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CasesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $this->reformatData();

        $rules = [
            'category_id' => ['required', 'string'],
            'image' => ['nullable'],
            'title' => ['required', 'string', 'min:2', 'max:255'],
            'goal' => ['nullable'],
            'geography' => ['nullable'],
            'placement_format' => ['nullable'],
            'period' => ['nullable'],
            'gender' => ['nullable'],
            'age' => ['nullable'],
            'income' => ['nullable'],
            'interest' => ['nullable'],
            'shows' => ['nullable'],
            'clicks' => ['nullable'],
            'ctr' => ['nullable'],
            'vtr' => ['nullable'],
            'cpv' => ['nullable'],
            'coverage' => ['nullable'],
            'refusals' => ['nullable'],
            'depth' => ['nullable'],
            'duration_session' => ['nullable'],
            'objectives' => ['nullable'],
        ];

        if ($this->method() == "POST") {
            $rules["image"][] = ["required", "image"];
        }

        if ($this->method() === "PUT" && !$this->hasFile('image')) {
            $rules["image"][] = 'string';
        }

        if ($this->method() === 'PUT' && $this->hasFile('image')) {
            $rules['image'][] = 'image';
        }

        return $rules;
    }

    /**
     * @return array
     */
    public function data(): array
    {
        return $this->only([
            'category_id',
            'image',
            'title',
            'goal',
            'geography',
            'placement_format',
            'period',
            'gender',
            'age',
            'income',
            'interest',
            'shows',
            'clicks',
            'ctr',
            'vtr',
            'cpv',
            'coverage',
            'refusals',
            'depth',
            'duration_session',
            'objectives',
        ]);
    }

    public function messages()
    {
        return [
            'image.required' => 'Изображение обязательно для заполнения.',
            'image.mimes' => 'Поддерживает форматы - jpg, jpeg, png, svg.',
            'title.required' => 'Это поле обязательно для заполнения.',
            'title.min' => 'Слишком короткое название.',
            'title.max' => 'Слишком длинное название.',
            'category_id.required' => 'Категория обязательна для заполнения.',
        ];
    }

    private function reformatData(): void
    {
        if ($this->image === 'null') {
            $this->merge(['image' => null]);
        }
    }
}