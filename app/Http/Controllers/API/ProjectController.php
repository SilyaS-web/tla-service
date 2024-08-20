<?php

namespace App\Http\Controllers\API;

use App\Models\Seller;
use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class ProjectController extends Controller
{

    public function index(Request $request)
    {
        $projects = Project::with('projectFiles')->get();
        foreach ($projects as &$project) {
            $project->status_name = $project->getStatusName();
            $project->project_works_with_quantity = $project->getProjectWorkNamesWithQuantity();
        }

        $data = [
            'projects' => $projects,
        ];

        return response()->json($data)->setStatusCode(200);
    }

    public function ban(Project $project)
    {
        $project->update(['status' => Project::BANNED]);
        return response()->json()->setStatusCode(200);

    }

    public function unban(Project $project)
    {
        $project->update(['status' => Project::PENDING]);
        return response()->json()->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blogger  $blogger
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blogger  $blogger
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seller $blogger)
    {
        //
    }
}
