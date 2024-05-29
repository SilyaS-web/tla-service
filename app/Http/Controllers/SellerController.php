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
    public function updateTariff(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'tariff' => ['required', Rule::in([Seller::TRIAL, Seller::START])],
        ]);

        if ($validator->fails()) {
            // return redirect()->route('profile')->withErrors($validator);
            return response()->json($validator->errors(), 400);
        }

        $validated = $validator->validated();
        $seller = Seller::where([['user_id', $user->id]])->first();
        switch ($validated['tariff']) {
            case Seller::START:
                $seller->remaining_tariff += Seller::TARIFFS[Seller::START]['quantity'];;
                $seller->tariff = Seller::TARIFFS[Seller::START]['name'];
                $seller->finish_date = date('Y-m-d' ,time() + (86400 * 30));
                $seller->save();
                break;
            case Seller::TRIAL:
                $seller->remaining_tariff += Seller::TARIFFS[Seller::TRIAL]['quantity'];
                $seller->tariff = Seller::TARIFFS[Seller::TRIAL]['name'];
                $seller->finish_date = date('Y-m-d' ,time() + (86400 * 30));
                $seller->save();

                break;

            default:
                break;
        }

        return view('tariff');
    }

    public function show(Seller $seller)
    {
        $user = $seller->user;
        $projects = Project::where('seller_id', $user->id)->get();
        return view('profile.public.seller', compact('user', 'projects'));
    }

}
