<?php

namespace App\Http\Controllers\API;

use App\Models\Seller;
use App\Http\Controllers\Controller;
use App\Http\Resources\SellerResource;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SellerController extends Controller
{

    public function index(Request $request)
    {
        $sellers = Seller::with('user')->get();
        $data = [
            'sellers' => $sellers,
        ];
        return response()->json($data)->setStatusCode(200);
    }

    public function show(Seller $seller) {
        $data = [
            'seller' => new SellerResource($seller),
        ];

        return  response()->json($data)->setStatusCode(200);
    }

    public function update(Request $request)
    {
        // $user = Auth::user();
        // $countries = Country::get();
        // $validator = Validator::make(request()->all(), [
        //     'user' => ''
        //     'name' => 'required|min:3',
        //     'email' => 'required|email',
        //     'image' => 'image|nullable',
        //     'old_password' => 'min:8|nullable',
        //     'password' => 'min:8|nullable',
        //     'wb_link' => 'string|nullable',
        //     'wb_api_key' => 'string|nullable',
        //     'ozon_link' => 'string|nullable',
        //     'ozon_client_id' => 'numeric|nullable',
        //     'ozon_api_key' => 'string|nullable',
        //     'inn' => 'string|nullable',
        //     'organization_type' => 'string|nullable',
        //     'organization_name' => 'string|nullable',
        // ]);

        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        // $validated = $validator->validated();
        // if (isset($validated['password'])) {
        //     if (auth()->attempt(['phone' => $user->phone, 'password' => $validated['old_password']])) {
        //         $user->password = bcrypt($validated['password']);
        //         $user->save();
        //     } else {
        //         return redirect()->route('edit-profile')->with('success', 'Введён неверный пароль');
        //     }
        // }

        // $user->name = $validated['name'];

        // if ($user->email != $validated['email']) {
        //     $user->email = $validated['email'];
        // }

        // if ($request->file('image')) {
        //     if (Storage::exists($user->getImageURL())) {
        //         Storage::delete($user->getImageURL());
        //     }

        //     $product_image = $request->file('image');
        //     $image_path = $product_image->store('profile', 'public');
        //     $user->image = $image_path;
        // }

        // $user->save();

        // if ($user->role == 'seller') {
        //     $this->updateSeller();
        // } else {
        //     $this->updateBlogger();
        // }

        // return redirect()->route('edit-profile')->with('success', 'Данные успешно обновлены');
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
