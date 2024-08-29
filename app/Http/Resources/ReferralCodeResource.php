<?php

namespace App\Http\Resources;

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
            'referral_users' => ReferralUserResource::collection($this->referralUsers),
        ];
    }
}
