<?php

namespace App\Http\Controllers;

use App\Models\Blogger;
use App\Models\BloggerPlatform;
use App\Models\BloggerTheme;
use App\Models\Project;
use App\Models\Platform;
use App\Models\Work;
use App\Services\TgService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;

class BloggerController extends Controller
{
    public function show(Blogger $blogger)
    {
        $user = $blogger->user;
        $works = Work::where([['blogger_id', $user->id]])->where('status', Work::COMPLETED)->get();
        $projects = Project::whereIn('id', $works->pluck('project_id'))->get();

        return view('profile.public.blogger', compact('user', 'projects'));
    }
}
