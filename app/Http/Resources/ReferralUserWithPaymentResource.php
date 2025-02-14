<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use JustCommunication\TinkoffAcquiringAPIClient\Model\Payment as TPayment;

class ReferralUserWithPaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->user_id,
            'name' => $this->user->name,
            'phone' => $this->user->phone,
            'role' => $this->user->role,
            'created_at' => isset($this->user->created_at) ? $this->user->created_at->format('d.m.Y H:i') : null,
            'payment_id' => $this->payment_id,
            'payment_data' => isset($this->created_at) ? $this->created_at->format('d.m.Y H:i') : null,
            'received' => $this->price / 100,
        ];
    }
}
