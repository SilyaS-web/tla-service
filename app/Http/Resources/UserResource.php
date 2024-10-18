<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        $organization_name = false;
        $channel_name = false;

        if ($this->role == 'seller') {
            $seller = $this->seller;
            $organization_name = isset($seller->organization_name) && !empty($seller->organization_name) ? $seller->organization_type . ' '. $seller->organization_name : '';
        } else if ($this->role == 'blogger') {
            $channel_name = $this->name;
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'image' => $this->getImageURL(),
            'status' => $this->status,
            'role' => $this->role,
            'seller_id' => $this->seller->id ?? false,
            'blogger_id' => $this->blogger->id ?? false,
            'is_blogger_on_moderation' => $this->status == 0 && isset($this->blogger) && !empty($this->blogger->sex),
            'organization_name' => $organization_name,
            'channel_name' => $channel_name,
            'created_at' => isset($this->created_at) ? $this->created_at->format('d.m.Y H:i') : null,
            'tariffs' => SellerTariffResource::collection($this->getActiveTariffs()),
            'is_admin' => (bool) $this->is_admin,
        ];
    }
}
