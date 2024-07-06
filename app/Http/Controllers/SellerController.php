<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Seller;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{
    public function show(Seller $seller)
    {
        $user = $seller->user;
        $projects = Project::where('seller_id', $user->id)->get();
        return view('profile.public.seller', compact('user', 'projects'));
    }

}
