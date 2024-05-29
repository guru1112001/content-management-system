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
            // 'content' => $this->content,
            // 'unlimited_view' => $this->unlimited_view,
            // 'maximum_views' => $this->maximum_views,
            // 'prerequisite' => $this->prerequisite,
            // 'privacy_allow_access' => $this->privacy_allow_access,
            // 'privacy_downloadable' => $this->privacy_downloadable,
            // 'published' => $this->published,
            // 'sort' => $this->sort,
            // 'doc_type' => $this->doc_type,
            // 'maximum_marks' => $this->maximum_marks,
            // 'passing_percentage' => $this->passing_percentage,
            // 'result_declaration' => $this->result_declaration,
            // 'maximum_attempts' => $this->maximum_attempts,
            // 'general_instructions' => $this->general_instructions,
            // 'start_submission' => $this->start_submission,
            // 'stop_submission' => $this->stop_submission,
        ];
    }
}
