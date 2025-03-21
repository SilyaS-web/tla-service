<?php

namespace App\Http\Resources;

use App\Models\Project;
use App\Models\Work;
use App\Services\WbService;
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
        $statCount = WbService::getFeedbackCounters($this->product_nm);
        $clicks_count = $this->getClicksCount();

        $user = Auth()->user();

        if ($user->role === 'blogger' && $user->blogger->platforms()->max('coverage') < 2000) {
            $project_works = $this->projectWorks()->where('type', Project::FEEDBACK)->where('is_auto_generated', false)->get();
        } else {
            $project_works = $this->projectWorks()->where('is_auto_generated', false)->get();
        }

        return [
            'id' => $this->id,
            'user_id' => $this->seller_id,
            'product_name' => $this->product_name,
            'product_nm' => $this->product_nm,
            'product_link' => $this->product_link,
            'product_price' => $this->product_price,
            'status' => $this->status,
            'status_name' => $this->getStatusName(),
            'project_works' => ProjectWorkResource::collection($project_works),
            'project_files' => ProjectFileResource::collection($this->projectFiles),
            'marketplace_brand' => $this->marketplace_brand,
            'marketplace_category' => $this->marketplace_category,
            'marketplace_product_name' => $this->marketplace_product_name,
            'marketplace_description' => $this->marketplace_description,
            'marketplace_options' => $this->marketplace_options,
            'marketplace_rate' => $this->marketplace_rate,
            'is_blogger_access' => (bool) $this->is_blogger_access,
            'active_bloggers_count' => $this->works()->where('status', '<>', null)->count(),
            'applications_sent_count' => $this->works()->whereNull('status')->where('created_by', $this->seller_id)->count(),
            'pending_bloggers_count' => $this->works()->where('status', 'pending')->count(),
            'in_work_bloggers_count' => $this->works()->where('status', 'progress')->count(),
            'completed_bloggers_count' => $this->works()->where('status', 'completed')->count(),
            'product_rating' => $statCount->reviewRating ?? 0,
            'product_feedbacks_count' => $statCount->feedbacks ?? 0,
            'clicks_count' => $clicks_count,
            'created_at' => isset($this->created_at) ? $this->created_at->format('d.m.Y') : null,
            'works_count' => $this->works()->count(),
            'is_blogger_works' => $this->when($request->user()->role == 'blogger', function () use ($request) {
                return Work::withTrashed()->where('blogger_id', $request->user()->id)->where('project_id', $this->id)->first() ? true : false;
            }),
        ];
    }
}
