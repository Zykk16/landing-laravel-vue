<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CasesCollection extends ResourceCollection
{

    public $collects = CasesResources::class;

    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            "data" => $this->collection
        ];
    }
}