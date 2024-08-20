<?php

namespace App\Http\Controllers\API;

use App\Models\Seller;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class SellerController extends Controller
{

    public function index(Request $request)
    {
        $sellers = Seller::with('user')->get();
        $data = [
            'data' => [
                'sellers' => $sellers,
            ]
         ];
        return response()->json($data)->setStatusCode(200);
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
