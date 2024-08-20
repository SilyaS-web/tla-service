<?php

namespace App\Http\Controllers\API;

use App\Models\Seller;
use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class PaymentController extends Controller
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
}
