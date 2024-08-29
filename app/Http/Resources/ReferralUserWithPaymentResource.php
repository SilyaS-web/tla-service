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
    public function toArray($request)
    {
        return [
            'id' => $this->user_id,
            'name' => $this->user->name,
            'phone' => $this->user->phone,
            'role' => $this->user->role,
            'created_at' => date_format($this->user->created_at, 'd.m.y'),
            'payment_id' => $this->payment_id,
            'payment_data' => date_format($this->created_at, 'd.m.y'),
            'received' => $this->price / 100,
        ];
    }
}
