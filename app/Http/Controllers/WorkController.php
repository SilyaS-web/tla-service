<?php

namespace App\Http\Controllers;

use App\Models\Work;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WorkController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'blogger_id' => 'required|exists:users,id',
            'seller_id' => 'required|exists:users,id',
            'project_id' => 'required|exists:projects,id',
        ]);

        if ($validator->fails()) {
            // return redirect()->route('profile')->withErrors($validator);
            return response()->json($validator->errors(), 400);
        }
        $validated = $validator->validated();
        $seller = User::find($validated['seller_id'])->seller;
        if ($seller) {
            if ($seller->remaining_tariff < 1) {
                return response()->json(['extend the tariff'], 400);
            }
        } else {
            return response()->json(['seller not found'], 400);
        }
        $seller->remaining_tariff -= 1;
        $seller->save();

        Work::create($validated);

        return redirect()->route('profile')->with('success', 'Заявка успешно отправлена');
    }

    public function acceptWorkByBlogger(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'work_id' => 'required|exists:works,id',
        ]);

        if ($validator->fails()) {
            // return redirect()->route('profile')->withErrors($validator);
            return response()->json($validator->errors(), 400);
        }

        $validated = $validator->validated();
        $work = Work::find($validated['work_id']);
        $work->status = 1;
        $work->save();

        return redirect()->route('profile')->with('success', 'Заявка успешно принята');
    }
}
