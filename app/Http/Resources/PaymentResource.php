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
            'payment_id' => $this->payment_id,
            'tariff' => $this->tariff->title , ' - ' . $this->tariff->tariffGroup->title,
            'created_at' => date_format($this->created_at, 'd.m.y'),
            'price' => $this->price / 100,
            'status' => $this->status,
        ];
    }
}
