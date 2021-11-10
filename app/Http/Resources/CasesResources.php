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
            'id'                => $this->id,
            'category_id'       => new CategoriesCasesResources($this->category),
            'image'             => $this->image,
            'title'             => $this->title,
            'goal'              => $this->goal,
            'geography'         => $this->geography,
            'placement_format'  => $this->placement_format,
            'period'            => $this->period,
            'gender'            => $this->gender,
            'age'               => $this->age,
            'income'            => $this->income,
            'interest'          => $this->interest,
            'shows'             => $this->shows,
            'clicks'            => $this->clicks,
            'ctr'               => $this->ctr,
            'vtr'               => $this->vtr,
            'cpv'               => $this->cpv,
            'coverage'          => $this->coverage,
            'refusals'          => $this->refusals,
            'depth'             => $this->depth,
            'duration_session'  => $this->duration_session,
            'objectives'        => $this->objectives,
            'created_at'        => $this->created_at
        ];
    }
}