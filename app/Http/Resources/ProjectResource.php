<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        $user = Auth()->user();
        $statCount = $this->getCountStatistics();
        $finish_stats = $this->getFinishStats();
        $clicks_count = $this->getClicksCount();
        $stats = $this->getStatistics($user->seller->ozon_client_id, $user->seller->ozon_api_key);

        return [
            'id' => $this->id,
            'user_id' => $this->seller_id,
            'product_name' => $this->product_name,
            'product_nm' => $this->product_nm,
            'product_link' => $this->product_link,
            'product_price' => $this->product_price,
            'status' => $this->status,
            'status_name' => $this->getStatusName(),
            'project_works' => ProjectWorkResource::collection($this->projectWorks),
            'project_files' => ProjectFileResource::collection($this->projectFiles),
            'marketplace_brand' => $this->marketplace_brand,
            'marketplace_category' => $this->marketplace_category,
            'marketplace_product_name' => $this->marketplace_product_name,
            'marketplace_description' => $this->marketplace_description,
            'marketplace_options' => $this->marketplace_options,
            'marketplace_rate' => $this->marketplace_rate,
            'is_blogger_access' => (bool) $this->is_blogger_access,
            'active_bloggers_count' => $this->works()->where('status', '<>', null)->count(),
            'applications_sent_count' => $this->works()->where('status', null)->where('created_by', $this->seller_id->id)->count(),
            'pending_bloggers_count' => $this->works()->where('status', 'pending')->count(),
            'in_work_bloggers_count' => $this->works()->where('status', 'progress')->count(),
            'completed_bloggers_count' => $this->works()->where('status', 'completed')->count(),
            'product_rating' => $statCount->reviewRating ?? 0,
            'product_feedbacks_count' => $statCount->feedbacks ?? 0,
            'clicks_count' => $clicks_count,
            'created_at' => date_format($this->created_at, 'd.m.y'),
        ];
    }
}
