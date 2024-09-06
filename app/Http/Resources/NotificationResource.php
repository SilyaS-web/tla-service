<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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
            'image' => $this->fromUser ? $this->fromUser->getImageURL() : asset('img/profile-icon.svg'),
            'title' => $this->type ?? 'Новое уведомление',
            'text' => $this->text,
            'is_work_active' => (bool) ($this->work && $this->work->status !== null),
            'work_id' => $this->work_id,
            'viewed_at' => isset($this->viewed_at) ? $this->viewed_at->format('Y-m-d H:i') : null,
            'created_at' => isset($this->created_at) ? $this->created_at->format('Y-m-d H:i') : null,
        ];
    }
}
