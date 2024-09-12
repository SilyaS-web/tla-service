<?php

namespace App\Http\Resources;

use App\Models\Tariff;
use Illuminate\Http\Resources\Json\JsonResource;

class TariffResource extends JsonResource
{
    public $preserveKeys = true;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'group_title' => $this->tariffGroup->title,
            'description' => $this->description,
            'price_conditions' => Tariff::PRICE_CONDITIONS,
            'minimal_quantities' => Tariff::MINIMAL_QUANTITY,
            'period' => $this->period,
            'is_active' => $this->is_active,
            'is_best' => $this->is_best,
        ];
    }
}
