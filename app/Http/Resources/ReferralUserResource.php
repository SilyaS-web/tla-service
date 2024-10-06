<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use JustCommunication\TinkoffAcquiringAPIClient\Model\Payment as TPayment;

class ReferralUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->user_id,
            'name' => $this->user->name,
            'phone' => $this->user->phone,
            'role' => $this->user->role,
            'created_at' => isset($this->user->created_at) ? $this->user->created_at->format('d.m.Y H:i') : null,
            'received' => $this->user->payments()->where('status', TPayment::STATUS_CONFIRMED)->sum('price') / 100,
        ];
    }
}
