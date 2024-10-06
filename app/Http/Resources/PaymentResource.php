<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
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
            'user_id' => $this->user_id,
            'seller_id' => $this->user->seller->id ?? false,
            'payment_id' => $this->payment_id,
            'tariff' => $this->tariff->title . ' - ' . $this->tariff->tariffGroup->title,
            'created_at' => isset($this->created_at) ? $this->created_at->format('d.m.Y') : null,
            'price' => $this->price / 100,
            'status' => $this->status,
        ];
    }
}
