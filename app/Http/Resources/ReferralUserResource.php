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
            'created_at' => date_format($this->user->created_at, 'd.m.y'),
            'received' => $this->user->payments()->where('status', TPayment::STATUS_CONFIRMED)->sum('price') / 100,
        ];
    }
}
