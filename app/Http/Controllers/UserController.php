<?php

namespace App\Http\Controllers;

use App\Models\Blogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Project;
use App\Models\Seller;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use App\Models\Work;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user();

        switch ($user->role) {
            case 'seller':
                $data = $this->getSellerProfileData();
                break;

            case 'blogger':
                $data = $this->getBloggerProfileData();
                break;

            case 'admin':
                $data = $this->getAdminProfileData();
                break;

            default:
                break;
        }

        return view("profile." . $user->role, $data);
    }

    public function getBloggerProfileData()
    {
        $user = Auth::user();
        $user_id = $user->id;

        $validator = Validator::make(request()->all(), [
            'project_type' => [Rule::in(Project::TYPES)],
            'project_name' => '',
            'status' => '',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $works = Work::where([['blogger_id', $user_id]])->get();
        $projects = Project::whereIn('id', $works->pluck('project_id'))->get();
        $all_projects = Project::where($validator->validated())->get();

        $role = $user->role;

        return compact('projects', 'all_projects', 'works', 'role', 'user_id');
    }


    public function getSellerProfileData()
    {
        $user = Auth::user();
        $user_id = $user->id;

        $validator = Validator::make(request()->all(), [
            'project_type' => [Rule::in(Project::TYPES)],
            'project_name' => '',
            'status' => '',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $projects = $user->projects()->where($validator->validated())->withCount(['works' => function (Builder $query) {
            $query->where('status', 1);
        }])->get();

        $bloggers = Blogger::get();

        $works = Work::where([['seller_id', $user_id]])->get();
        $role = 'blogger';
        return compact('projects', 'bloggers', 'works', 'role', 'user_id');
    }

    public function getAdminProfileData()
    {
        $validator = Validator::make(request()->all(), [
            'user_name' => 'string',
            'blogger_name' => 'string',
            'seller_name' => 'string',
        ]);

        if ($validator->fails()) {
            return [];
        }
        $validated = $validator->validated();

        $filter = [
            ['role', 'blogger'],
            ['status', 0],
        ];

        if (!empty($validated['user_name'])) {
            $filter[] = ['user_name', 'like', '%' . $validated['user_name'] . '%'];
        }

        $unverified_users = User::where($filter)->get();

        $bloggers = [];
        if (!empty($validated['blogger_name'])) {
            $bloggers = Blogger::whereHas('user', function (Builder $query) use ($validated) {
                $query->where('name', 'like', '%' . $validated['blogger_name'] . '%');
            })->get();
        } else {
            $bloggers = Blogger::get();
        }

        $sellers = [];
        if (!empty($validated['seller_name'])) {
            $sellers = Seller::whereHas('user', function (Builder $query) use ($validated) {
                $query->where('name', 'like', '%' . $validated['seller_name'] . '%');
            })->get();
        } else {
            $sellers = Seller::get();
        }


        return compact('unverified_users', 'bloggers', 'sellers');
    }

    public function update()
    {
        if (request()->has('image')) {
            $imagePath = request()->file('product_image')->store('projects', 'public');
            $validated['product_image'] = $imagePath;
            $validated['customer_id'] = Auth::user()->id;
        }
    }
}
