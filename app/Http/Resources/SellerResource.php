<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SellerResource extends JsonResource
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
            'organization_name' => $this->organization_name,
            'organization_type' => $this->organization_type,
            'is_achievement' => (bool) $this->is_achievement,
            'is_agent' => (bool) $this->is_agent,
            'description' => $this->description,
            'inn' => $this->inn,
            'wb_link' => $this->description,
            'wb_api_key' => $this->description,
            'ozon_link' => $this->description,
            'ozon_api_key' => $this->description,
            'ozon_client_id' => $this->description,
            'created_at' => isset($this->created_at) ? $this->created_at->format('d.m.Y H:i') : null,
            'user' => new UserResource($this->user),
        ];
    }
}
