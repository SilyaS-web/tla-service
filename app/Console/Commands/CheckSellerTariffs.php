<?php

namespace App\Console\Commands;

use App\Models\Project;
use App\Models\SellerTariff;
use App\Models\Tariff;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckSellerTariffs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-seller-tariffs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Проверяет тарифы, и приостанавливает проекты';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $active_projects = Project::query()->where('status', 0)->get();
        foreach ($active_projects as $project) {
            $seller_tariffs = SellerTariff::query()->where('user_id', $project->seller_id)->where('finish_date', '>', Carbon::now())->where('type', Project::BARTER)->whereNot('quantity',  0)->first();
            if (!$seller_tariffs) {
                $this->info('ID проекта: ' . $project->id . ', название проекта: ' . $project->product_name . ', ID пользователя: ' . $project->seller_id);
                $project->update(['status' => Project::STOPPED]);
            }
        }
    }
}
