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
        $result = [];
        foreach ($this->user->payments()->where('status', TPayment::STATUS_CONFIRMED)->get() as $payment) {
            $result[] = [
                'id' => $this->user_id,
                'name' => $this->user->name,
                'phone' => $this->user->phone,
                'role' => $this->user->role,
                'created_at' => date_format($this->user->created_at, 'd.m.y'),
                'payment_id' => $payment->payment_id,
                'payment_data' => $payment->payment_id,
                'received' => $payment->price / 100,
            ];
        }
        if (!empty($result)) {
            return $result;
        }
    }
}
