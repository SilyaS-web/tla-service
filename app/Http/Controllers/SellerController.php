<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectWork;
use App\Models\Seller;
use App\Models\Work;
use App\Services\TgService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SellerController extends Controller
{
    public function show(Seller $seller)
    {
        $user = $seller->user;
        $projects = Project::where('seller_id', $user->id)->get();
        return view('profile.public.seller', compact('user', 'projects'));
    }


    public function checkTariffs()
    {
        Log::channel('single')->info('checkTariffs');
        $sellers = Seller::get();
        foreach ($sellers as $seller) {
            $user = $seller->user;
            TgService::notify($user->tgPhone->chat_id, 'Проверяем ваши тарифы');
            foreach ($seller->sellerTariffs as $seller_tariff) {
                if ($seller_tariff->finish_date >= Carbon::now()->addDays(7) && $seller_tariff->finish_date < Carbon::now()->addDays(8)) {
                    TgService::notify($user->tgPhone->chat_id, 'Скоро заканчивается срок действия вашего тарифного плана ' . $seller_tariff->tariff->tariffGroup->title . '! Не забудьте продлить его, чтобы продолжить работу.');
                } else if ($seller_tariff->finish_date < Carbon::now()) {
                    TgService::notify($user->tgPhone->chat_id, 'Срок действия вашего тарифного плана ' . $seller_tariff->tariff->tariffGroup->title . ' истёк!');
                    $seller_tariff->delete();
                }
            }
        }
    }

    public function checkProjectWorks()
    {
        Log::channel('single')->info('checkProjectWorks');
        $project_works = ProjectWork::where('finish_date', '>', Carbon::now())->withCount(['works' => function (Builder $query) {
            $query->whereIn('status', [Work::IN_PROGRESS, Work::COMPLETED])->count();
        }])->get();

        foreach ($project_works as $project_work) {
            $seller = $project_work->project->seller;
            $active_tariff = $seller->getActiveTariffs($project_work->type);
            if ($active_tariff) {
                if ($active_tariff->quantity >= $project_work->quantity) {
                    $active_tariff->update(['quantity' => $active_tariff->quantity - $project_work->quantity]);
                } else {
                    $project_work_lost = $project_work->quantity - $project_work->works_count;
                    $project_work->quantity = $project_work_lost - $active_tariff->quantity;
                    $active_tariff->update(['quantity' => 0]);
                }

                $project_work->finish_date = $active_tariff->finish_date;
                $project_work->save();

                if ($active_tariff->quantity < 1) {
                    $active_tariff->delete();
                }
            } else {
                $project_work->update(['quantity' => $project_work->works_count]);
            }
        }
    }
}
