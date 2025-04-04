<?php
namespace App\Exports;

use App\Models\ReferralUser;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use JustCommunication\TinkoffAcquiringAPIClient\Model\Payment as TPayment;

class ReferralExports implements FromCollection, WithHeadings, WithMapping
{
    use Exportable;
    public $referral_code_id = null;

    public function __construct(int $referral_code_id)
    {
        $this->referral_code_id = $referral_code_id;
    }

    public function headings(): array
    {
        return [
            'ID',
            'ФИО',
            'Номер',
            'Роль',
            'Дата регистрации',
            'Оплата',
        ];
    }

    public function map($referral_user): array
    {
        return [
            $referral_user->user_id,
            $referral_user->user->name,
            $referral_user->user->phone,
            $referral_user->user->role,
            date_format($referral_user->user->created_at, 'd.m.y H:i'),
            $referral_user->user->payments()->where('status', TPayment::STATUS_CONFIRMED)->sum('price') / 100,
        ];
    }

    public function collection()
    {
        return ReferralUser::where('referral_code_id', $this->referral_code_id)->get();
    }
}
