<?php

namespace App\Http\Resources;

use App\Models\Work;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectWorkResource extends JsonResource
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
            'project_id' => $this->project_id,
            'type' => $this->type,
            'name' => $this->getProjectWorkName(),
            'quantity' => $this->quantity,
            'lost_quantity' => $this->quantity - $this->works()->where('project_work_id', $this->id)->whereIn('status', [Work::IN_PROGRESS, Work::COMPLETED])->count(),
            'created_at' => isset($this->created_at) ? $this->created_at->format('d.m.Y H:i') : null,
        ];
    }
}
