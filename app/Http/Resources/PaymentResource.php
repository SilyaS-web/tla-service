<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PaymentResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
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
