<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {

        $image_url = asset('img/profile-icon.svg');
        if ($this->fromUser) {
            $image_url = $this->fromUser->getImageURL();
        } else if ($this->work && $user = Auth::user()) {
            $image_url = $this->work->getPartnerUser($user->role)->getImageURL();
        }

        return [
            'id' => $this->id,
            'image' =>  $image_url,
            'title' => $this->type ?? 'Новое уведомление',
            'text' => $this->text,
            'is_work_active' => (bool) ($this->work && $this->work->status !== null),
            'work_id' => $this->work_id,
            'viewed_at' => isset($this->viewed_at) ? $this->viewed_at->format('Y-m-d H:i') : null,
            'created_at' => isset($this->created_at) ? $this->created_at->format('Y-m-d H:i') : null,
        ];
    }
}
