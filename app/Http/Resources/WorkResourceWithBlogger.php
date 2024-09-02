<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WorkResourceWithBlogger extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'blogger_id' => $this->blogger_id,
            'seller_id' => $this->seller_id,
            'project_id' => $this->project_id,
            'message' => $this->message,
            'accepted_by_blogger_at' => date_format($this->accepted_by_blogger_at, 'd.m.y H:i'),
            'accepted_by_seller_at' => date_format($this->accepted_by_seller_at, 'd.m.y H:i'),
            'confirmed_by_blogger_at' => date_format($this->confirmed_by_blogger_at, 'd.m.y H:i'),
            'confirmed_by_seller_at' => date_format($this->confirmed_by_seller_at, 'd.m.y H:i'),
            'status' => $this->getStatus(),
            'created_by' => $this->created_by,
            'project_work_id' => $this->project_work_id,
            'last_message_at' => date_format($this->last_message_at, 'd.m.y H:i'),
            'created_at' => date_format($this->created_at, 'd.m.y H:i'),
            'blogger' => new BloggerResource($this->blogger),
        ];
    }
}
