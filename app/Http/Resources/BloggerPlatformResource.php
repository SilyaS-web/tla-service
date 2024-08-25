<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BloggerPlatformResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'platform_id' => $this->platform_id,
            'subscriber_quantity' => $this->subscriber_quantity,
            'coverage' => $this->coverage,
            'additional_coverage' => $this->additional_coverage,
            'link' => $this->link,
            'engagement_rate' => $this->engagement_rate,
            'additional_engagement_rate' => $this->additional_engagement_rate,
            'cost_per_mille' => $this->cost_per_mille,
            'image' => $this->platform->image,
            'title' => $this->platform->title,
        ];
    }
}
