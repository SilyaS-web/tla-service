<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'specification' => $this->specification,
            'price' => $this->price,
            'complete_till' => $this->complete_till,
            'completed_at' => $this->completed_at,
            'status' => $this->status,
            'files' => OrderFileResource::collection($this->files)
        ];
    }
}
