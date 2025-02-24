<?php

namespace App\Http\Resources;

use App\Models\ProjectWork;
use App\Models\User;
use App\Models\WorkProjectWork;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class WorkResource extends JsonResource
{
    private $with_array;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        $user = Auth::user();
        $project = null;
        if (isset($user) && $user->role == User::BLOGGER && $this->project) {
            $project = new ProjectResource($this->project);

        } else if (request()->input('with') && in_array('project', request()->input('with')) && $this->project) {
            $project = [
                'product_name' => $this->project->product_name,
                'product_nm' => $this->project->product_nm,
                'project_files' => ProjectFileResource::collection($this->project->projectFiles),
                'product_price' => $this->product_price,
            ];
        }

        $work_project_work_ids = WorkProjectWork::where('work_id', $this->id)->pluck('project_work_id');
        $project_works = ProjectWorkResource::collection(ProjectWork::whereIn('id', $work_project_work_ids)->get());
        return [
            'id' => $this->id,
            'blogger' => $this->when($user->role != 'blogger', function () use ($request) {
                return new BloggerResource($this->blogger);
            }),
            'partner_user' => new UserResource($this->getPartnerUser($user->role)),
            'seller_user_id' => $this->seller_id,
            'blogger_user_id' => $this->blogger_id,
            'project_id' => $this->project_id,
            'project' => $project,
            'message' => $this->message,
            'product_name' => $this->project->product_name ?? 'Проект удалён или заблокирован',
            'accepted_by_blogger_at' => isset($this->accepted_by_blogger_at) ? $this->accepted_by_blogger_at->format('Y-m-d H:i') : null,
            'accepted_by_seller_at' => isset($this->accepted_by_seller_at) ? $this->accepted_by_seller_at->format('Y-m-d H:i') : null,
            'confirmed_by_blogger_at' => isset($this->confirmed_by_blogger_at) ? $this->confirmed_by_blogger_at->format('Y-m-d H:i') : null,
            'confirmed_by_seller_at' => isset($this->confirmed_by_seller_at) ? $this->confirmed_by_seller_at->format('Y-m-d H:i') : null,
            'canceled_by_blogger_at' => isset($this->canceled_by_blogger_at) ? $this->canceled_by_blogger_at->format('Y-m-d H:i') : null,
            'canceled_by_seller_at' => isset($this->canceled_by_seller_at) ? $this->canceled_by_seller_at->format('Y-m-d H:i') : null,
            'status' => $this->status,
            'status_name' => $this->getStatus(),
            'created_by' => $this->created_by,
            'project_work_id' => $this->project_work_id,
            'last_message_at' => isset($this->last_message_at) ? $this->last_message_at->format('Y-m-d H:i') : null,
            'created_at' => isset($this->created_at) ? $this->created_at->format('Y-m-d H:i') : null,
            'statistics' => new FinishStatsResource($this->finishStats),
            'new_messages_count' => $this->messages()->where('viewed_at', null)->where('user_id', '<>', $user->id)->count(),
            'project_work' => $project_works,
            'files' => WorkFileResource::collection($this->files)
        ];
    }
}
