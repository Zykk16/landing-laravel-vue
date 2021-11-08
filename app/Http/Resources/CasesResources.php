<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CasesResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'category_id' => new CategoriesCasesResources($this->category),
            'image' => $this->image,
            'goal' => $this->goal,
            'geography' => $this->geography,
            'income' => $this->income,
            'gender' => $this->gender,
            'created_at' => $this->created_at
        ];
    }
}