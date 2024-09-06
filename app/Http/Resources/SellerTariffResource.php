<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SellerTariffResource extends JsonResource
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
            'tariff_id' => $this->tariff_id,
            'quantity' => $this->quantity,
            'type' => $this->type,
            'finish_date' => isset($this->finish_date) ? $this->finish_date->format('Y-m-d H:i') : null,
            'activation_date' => isset($this->activation_date) ? $this->activation_date->format('Y-m-d H:i') : null,
            'can_extend' => $this->canExtend(),
            'title' =>  $this->tariff->tariffGroup->title . ' - ' . $this->tariff->title,
        ];
    }
}
