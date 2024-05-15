<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->course_package->id,
            'name' => $this->course_package->name,
            'course_type' => $this->course_package->course_type,
            'description'=>$this->course_package->short_description,
            'image_url' => asset('storage/' . $this->course_package->image),
            
        ];
    }
}
