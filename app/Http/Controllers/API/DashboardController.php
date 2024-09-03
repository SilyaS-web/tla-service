<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentResource;
use App\Models\DeepLink;
use App\Models\DeepLinkStat;
use App\Models\Payment;
use App\Models\Work;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $wb_stats = $user->seller->getWBFeedbackStats();
        $projects = $user->projects()->withCount(['works' => function (Builder $query) {
            $query->where('status', 1);
        }])->get();

        $start_date = now()->subDays(30);
        $end_date = now();

        $works = Work::where([['seller_id', $user->id]])->get();
        $deep_link_ids = DeepLink::whereIn('work_id', $works->pluck('id'))->get()->pluck('id');
        $deep_link_stats = DeepLinkStat::selectRaw('DATE_FORMAT(created_at, "%Y-%m-%e") as date')->whereHas('deepLink', function (Builder $query) use ($deep_link_ids) {
            $query->whereIn('link_id', $deep_link_ids);
        })->whereBetween('created_at', [$start_date, $end_date])->get();

        $total_stats = [];
        $total_clicks = 0;
        foreach ($deep_link_stats as $deep_link_stat) {
            $total_clicks += 1;
            if (isset($total_stats[$deep_link_stat->date])) {
                $total_stats[$deep_link_stat->date]['coverage'] += 1;
            } else {
                $total_stats[$deep_link_stat->date] = [
                    'dt' => $deep_link_stat->date,
                    'coverage' => 1,
                    'bloggers' => 0
                ];
            }
        }

        $bloggers_finish = Work::selectRaw('DATE_FORMAT(confirmed_by_seller_at, "%Y-%m-%e") as date')->where('seller_id', $user->id)->where('status', Work::COMPLETED)->whereBetween('created_at', [$start_date, $end_date])->get();
        foreach ($bloggers_finish as $blogger_finish) {
            if (isset($total_stats[$blogger_finish->date])) {
                $total_stats[$blogger_finish->date]['bloggers'] += 1;
            } else {
                $total_stats[$blogger_finish->date] = [
                    'dt' => $blogger_finish->date,
                    'coverage' => 0,
                    'bloggers' => 1
                ];
            }
        }
        $subscribers = 0;
        foreach ($projects as $project) {
            $subscribers = ($subscribers + $project->getSuscribers()) / 2;
        }

        $data = [
            'is_wb_api_key' => isset($user->seller->wb_api_key) && !empty($user->seller->wb_api_key),
            'total_feedbacks_count' => $wb_stats["total"],
            'avg_feedbacks_value' => $wb_stats["avg"],
            'products_bad_feedbacks' => $wb_stats["low"],
            'products_good_feedbacks' => $wb_stats["mid"],
            'products_great_feedbacks' => $wb_stats["hig"],
            'products_few_feedbacks_count' => $wb_stats["pr_low"],
            'products_normal_feedbacks_count' => $wb_stats["pr_low"],
            'unanswered_feedbacks_count' => $user->seller->getCountUnansweredWB(),
            'total_clicks' => $total_clicks,
            'statistics' => $total_stats,
            'feedback_ratio' => $wb_stats["percent"],
        ];

        return response()->json($data)->setStatusCode(200);
    }
}
