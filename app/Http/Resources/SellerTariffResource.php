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
            'tariff_id' => $this->id,
            'quantity' => $this->theme,
            'type' => $this->theme,
            'finish_date' => isset($this->finish_date) ? $this->finish_date->format('Y-m-d H:i') : null,
            'activation_date' => isset($this->activation_date) ? $this->activation_date->format('Y-m-d H:i') : null,
            'can_extend' => $this->canExtend(),
            'title' =>  $this->tariff->tariffGroup->title . ' - ' . $this->tariff->title,
        ];
    }
}
