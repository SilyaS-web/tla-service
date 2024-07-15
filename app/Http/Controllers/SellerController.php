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
            $active_tariff = $seller->getActiveTariffs($project_work->type);
            $works_count = Work::where('project_work_id', $project_work->id)->whereIn('status', [Work::IN_PROGRESS, Work::COMPLETED])->count();
            if (!$active_tariff) {
                $project_work->update(['quantity' => $works_count]);
            }
        }
    }

    public function projects(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'project_name' => 'string|nullable',
            'project_type' => 'string|nullable',
            'category' => 'string|nullable',
            'type' => 'string|nullable'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validated = $validator->validated();
        $all_projects = Project::where('status', '<>', Project::BANNED)->where('created_at', '<', Carbon::now()->subMinutes(5))->where('is_blogger_access', true);

        if (isset($validated['project_type']) && !empty($validated['project_type'])) {
            $all_projects->whereHas('projectWorks', function (Builder $query) use ($validated) {
                $query->where('type', $validated['project_type']);
            });
        }

        if (isset($validated['project_name']) && !empty($validated['project_name'])) {
            $all_projects->where('product_name', 'like', '%' . $validated['project_name'] . '%');
        }

        if (isset($validated['category']) && !empty($validated['category'])) {
            $all_projects->where('marketplace_category', 'like', '%' . $validated['category'] . '%');
        }

        $all_projects = $all_projects->get();
        return view('project.all-seller-list', compact('all_projects'));
    }
}
