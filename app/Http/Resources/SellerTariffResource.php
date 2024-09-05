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
            'finish_date' => date_format($this->finish_date, 'd.m.y H:i'),
            'activation_date' => date_format($this->activation_date, 'd.m.y H:i'),
            'can_extend' => $this->canExtend(),
            'title' =>  $this->tariff->tariffGroup->title . ' - ' . $this->tariff->title,
        ];
    }
}
