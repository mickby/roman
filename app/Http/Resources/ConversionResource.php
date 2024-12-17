<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConversionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'integer_value' => $this->integer_value,
            'roman_value' => $this->roman_value,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
