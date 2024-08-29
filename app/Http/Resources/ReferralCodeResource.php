<?php

namespace App\Http\Resources;

use App\Models\Payment;
use Illuminate\Http\Resources\Json\JsonResource;
use JustCommunication\TinkoffAcquiringAPIClient\Model\Payment as TPayment;

class ReferralCodeResource extends JsonResource
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
            'user_id' => $this->user_id,
            'code' => $this->code,
            'name' => $this->name,
            'referral_users' => ReferralUserResource::collection($this->referralUsers),
            'referral_users_with_payments' => ReferralUserWithPaymentResource::collection(Payment::whereIn('user_id', $this->referralUsers->pluck('id')->all())->where('status', TPayment::STATUS_CONFIRMED)->get()),
        ];
    }
}
