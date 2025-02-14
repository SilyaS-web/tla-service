<?php

namespace App\Services;

use App\Http\Requests\User\StoreUserRequest;
use App\Models\TgPhone;
use App\Models\User;

class UserService
{
    /**
     * @throws \Exception
     */
    public static function store(array $data): User
    {
        $phone = $data['phone'];
        $tg_phone = TgPhone::query()->where('phone', $phone)->first();

        if (!$tg_phone) {
            throw new \Exception('Телеграм не подтверждён');
        }

        $data['status'] = $data['role'] == 'seller' ? 1 : 0;

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $phone,
            'tg_phone_id' => $tg_phone->id,
            'role' => 'seller',
            'status' => $data['status'],
            'password' => bcrypt($data['password']),
        ]);

        if (session()->has('ref_code')) {
            $ref_code = session()->get('ref_code');
            ReferralService::ref($user->id, $ref_code);
        }

        if (in_array($data['role'], ['seller', 'agent'])) {
            SellerService::store($user, $data);
        } else if ($data['role'] == 'blogger') {
            BloggerService::store($user, $data['platforms']);
        }

        return $user;
    }
}
