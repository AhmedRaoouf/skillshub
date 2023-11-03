<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name_en" => $this->name('en'),
            "name_ar" => $this->name('ar'),
            "description_ar" => $this->description('ar'),
            "description_en" => $this->description('en'),
            "image" => asset("uploads/$this->image"),
            "questions_no" => $this->questions_no,
            "difficulty" => $this->difficulty,
            "duration_mins" => $this->duration_mins,
            "Questions" => QuestionResource::collection($this->whenLoaded('questions')),
        ];
    }
}
