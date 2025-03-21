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
        $sellers = Seller::get();
        foreach ($sellers as $seller) {
            $user = $seller->user;
            foreach ($seller->sellerTariffs as $seller_tariff) {
                if ($seller_tariff->finish_date >= Carbon::now()->addDays(7) && $seller_tariff->finish_date < Carbon::now()->addDays(8)) {
                    TgService::notify($user->tgPhone->chat_id, 'Скоро заканчивается срок действия вашего тарифного плана ' . $seller_tariff->tariff->tariffGroup->title . '! Не забудьте продлить его, чтобы продолжить работу.');
                } else if ($seller_tariff->finish_date < Carbon::now()) {
                    TgService::notify($user->tgPhone->chat_id, 'Срок действия вашего тарифного плана ' . $seller_tariff->tariff->tariffGroup->title . ' истёк!');
                    $seller_tariff->delete();
                }
            }
        }

        $this->checkProjectWorks();
    }

    public function checkProjectWorks()
    {
        $project_works = ProjectWork::where('finish_date', '<', Carbon::now())->get();

        foreach ($project_works as $project_work) {
            $seller = $project_work->project->seller;
            $user = $seller->user;
            $active_tariff = $user->getActiveTariffs($project_work->type);
            $works_count = Work::where('project_work_id', $project_work->id)->whereIn('status', [Work::IN_PROGRESS, Work::COMPLETED])->count();
            if (!$active_tariff) {
                $project_work->update(['quantity' => $works_count]);
            }
        }
    }
}
