<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FinishStatsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'message_id' => $this->message_id,
            'subs' => $this->subs,
            'views' => $this->views,
            'reposts' => $this->reposts,
            'likes' => $this->likes,
            'stats' => $this->stats,
            'status' => $this->status,
            'city' => $this->city,
        ];
    }
}
