<?php

namespace App\Http\Controllers\API;

use App\Models\Seller;
use App\Http\Controllers\Controller;
use App\Http\Resources\SellerResource;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

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
            'name' => 'required|min:3',
            'email' => 'required|email',
            'image' => 'image|nullable',
            'old_password' => 'min:8|nullable',
            'password' => 'min:8|nullable',
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
        if (isset($validated['password']) && null != $validated['password']) {
            $credentials = [
                'phone' => $user->phone,
                'password' => $validated['old_password'],
            ];
            if (Auth::guard('web')->attempt($credentials)) {
                $user->password = bcrypt($validated['password']);
                $user->save();
            } else {
                return response()->json(['old_password' => 'Введён неверный пароль'])->setStatusCode(400);
            }
        }

        $user->name = $validated['name'];

        if ($user->email != $validated['email']) {
            $user->email = $validated['email'];
        }

        if ($request->file('image')) {
            if (Storage::exists($user->getImageURL())) {
                Storage::delete($user->getImageURL());
            }

            $seller_image = $request->file('image');
            $urls = ImageService::makeCompressedCopies($seller_image, 'profile/'.$user->id);

            $user->image = $urls[1];
        }

        $user->save();
        $seller->update([
            'wb_link' => $validated['wb_link'] ?? null,
            'wb_api_key' => $validated['wb_api_key'] ?? null,
            'ozon_api_key' => $validated['ozon_api_key'] ?? null,
            'ozon_link' => $validated['ozon_link'] ?? null,
            'ozon_client_id' => $validated['ozon_client_id'] ?? null,
            'inn' => $validated['inn'] ?? null,
            'organization_type' => $validated['organization_type'] ?? null,
            'organization_name' => $validated['organization_name'] ?? null,
        ]);

        return  response()->json(isset($image_path) ? ['image' => 'storage/' . $image_path] : '')->setStatusCode(200);
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
