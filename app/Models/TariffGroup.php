<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class TariffGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
    ];

    public function tariffs()
    {
        return $this->hasMany(Tariff::class, 'group_id', 'id');
    }

    public function getLost() {
        $user = Auth::user();
        $active_tariff = $this->tariffs()->whereHas('sellerTariffs', function (Builder $query) use ($user) {
            $query->where('user_id', $user->id)->where('finish_date', '>', Carbon::now());
        })->first();

        if (!$active_tariff) {
            return 0;
        }
        $type = $active_tariff->type;
        return $active_tariff->quantity - $user->seller->works()->whereHas('projectWork', function (Builder $query) use ($type) {
            $query->where('type', $type);
        })->whereIn('status', [Work::IN_PROGRESS, Work::COMPLETED])->count();
    }
}
