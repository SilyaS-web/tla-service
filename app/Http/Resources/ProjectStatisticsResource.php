<?php

namespace App\Http\Resources;

use App\Services\WbService;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectStatisticsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        $user = Auth()->user();
        $finish_stats = $this->getFinishStats();
        $clicks_count = $this->getClicksCount();
        $stats = $this->getStatistics($user->seller->ozon_client_id, $user->seller->ozon_api_key);

        return [
            'clicks_count' => $clicks_count,
            'completed_works' => WorkResource::collection($this->works()->get()),
            'completed_works_statistics' => $finish_stats,
            'marketplace_statistics' => $stats,
        ];
    }
}
