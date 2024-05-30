<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeachingMaterialResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'material_name' => $this->name,
            // 'description' => $this->description,
            'material_source' => $this->material_source,
            'file' => $this->file ? asset('storage/' . $this->file) : null,
           
        ];
    }
}
