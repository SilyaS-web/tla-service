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
            'accepted_by_blogger_at' => isset($this->accepted_by_blogger_at) ? $this->accepted_by_blogger_at->format('d.m.Y H:i') : null,
            'accepted_by_seller_at' => isset($this->accepted_by_seller_at) ? $this->accepted_by_seller_at->format('d.m.Y H:i') : null,
            'confirmed_by_blogger_at' => isset($this->confirmed_by_blogger_at) ? $this->confirmed_by_blogger_at->format('d.m.Y H:i') : null,
            'confirmed_by_seller_at' => isset($this->confirmed_by_seller_at) ? $this->confirmed_by_seller_at->format('d.m.Y H:i') : null,
            'status' => $this->getStatus(),
            'created_by' => $this->created_by,
            'project_work_id' => $this->project_work_id,
            'last_message_at' => isset($this->last_message_at) ? $this->last_message_at->format('d.m.Y H:i') : null,
            'created_at' => isset($this->created_at) ? $this->created_at->format('d.m.Y H:i') : null,
            'blogger' => new BloggerResource($this->blogger),
        ];
    }
}
