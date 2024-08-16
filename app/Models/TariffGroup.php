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
        $group_id = $this->id;
        
        $active_seller_tariffs_quantity = SellerTariff::where('user_id', $user->id)->whereHas('tariff', function (Builder $query) use ($group_id) {
            $query->where('group_id', $group_id);
        })->where('finish_date', '>', Carbon::now())->sum('quantity');
        return $active_seller_tariffs_quantity;
    }
}
