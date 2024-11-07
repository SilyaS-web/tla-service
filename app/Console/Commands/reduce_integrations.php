<?php

namespace App\Console\Commands;

use App\Models\Project;
use App\Models\ProjectWork;
use App\Models\Work;
use Illuminate\Console\Command;

class reduce_integrations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'integrations:reduce';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $project_works = ProjectWork::all();

        foreach ($project_works as $project_work) {
            if ($project_work->type == Project::FEEDBACK) {
                $project_work->update([
                    'quantity' => -1,
                ]);
                continue;
            }

            if ($project_work->type == Project::INTEGRATION) {
                continue;
            }

            $integration_project_work = ProjectWork::where('project_id', $project_work->project_id)
                ->where('type', Project::INTEGRATION)
                ->where('finish_date', $project_work->finish_date)
                ->first();

            if (!$integration_project_work) {
                $integration_project_work = ProjectWork::create([
                    'type' => Project::INTEGRATION,
                    'quantity' => -1,
                    'project_id' => $project_work->project_id,
                    'finish_date' => $project_work->finish_date,
                    'created_at' => $project_work->created_at,
                    'updated_at' => $project_work->updated_at,
                ]);
            } else {
                $integration_project_work->update([
                    'quantity' => -1,
                ]);
            }

            $works = Work::where('project_work_id', $project_work->id);
            $works->update([
                'project_work_id' => $integration_project_work->id
            ]);

            $project_work->delete();
        }
    }
}
