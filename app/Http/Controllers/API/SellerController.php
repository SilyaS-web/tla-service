<?php

namespace App\Http\Controllers\API;

use App\Models\Seller;
use App\Http\Controllers\Controller;
use App\Http\Resources\SellerResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

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

    public function update(Seller $seller, Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'user' => 'array',
            'user.name' => 'required|min:3',
            'user.email' => 'required|email',
            'user.image' => 'image|nullable',
            'user.old_password' => 'min:8|nullable',
            'user.password' => 'min:8|nullable',
            'wb_link' => 'string|nullable',
            'wb_api_key' => 'string|nullable',
            'ozon_link' => 'string|nullable',
            'ozon_client_id' => 'numeric|nullable',
            'ozon_api_key' => 'string|nullable',
            'inn' => 'string|nullable',
            'organization_type' => 'string|nullable',
            'organization_name' => 'string|nullable',
        ]);

        if ($validator->fails()) {
            return  response()->json($validator->errors())->setStatusCode(400);
        }

        $validated = $validator->validated();

        $user = $seller->user;
        if (isset($validated['user']['password'])) {
            if (auth()->attempt(['phone' => $user->phone, 'password' => $validated['user']['old_password']])) {
                $user->password = bcrypt($validated['user']['password']);
                $user->save();
            } else {
                return  response()->json(['message' => 'Введён неверный пароль'])->setStatusCode(400);
            }
        }

        $user->name = $validated['user']['name'];

        if ($user->email != $validated['user']['email']) {
            $user->email = $validated['user']['email'];
        }

        if ($request->file('image')) {
            if (Storage::exists($user->getImageURL())) {
                Storage::delete($user->getImageURL());
            }

            $product_image = $request->file('image');
            $image_path = $product_image->store('profile', 'public');
            $user->image = $image_path;
        }

        $user->save();
        $seller->update([
            'wb_link' => $validated['wb_link'],
            'wb_api_key' => $validated['wb_api_key'],
            'ozon_api_key' => $validated['ozon_api_key'],
            'ozon_link' => $validated['ozon_link'],
            'ozon_client_id' => $validated['ozon_client_id'],
            'inn' => $validated['inn'],
            'organization_type' => $validated['organization_type'],
            'organization_name' => $validated['organization_name'],
        ]);

        return  response()->json()->setStatusCode(200);
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
