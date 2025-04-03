<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\BloggerContentResource;
use App\Models\Blogger;
use App\Models\BloggerContent;
use App\Models\BloggerPlatform;
use App\Http\Controllers\Controller;
use App\Http\Resources\BloggerResource;
use App\Models\BloggerTheme;
use App\Services\ImageService;
use App\Services\TgService;
use App\Services\VideoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class BloggerController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|nullable',
            'platform' => 'nullable',
            'subscriber_quantity_min' => 'numeric|nullable',
            'subscriber_quantity_max' => 'numeric|nullable',
            'city' => 'string|nullable',
            'country' => 'numeric|exists:countries,id|nullable',
            'sex' => 'array|nullable',
            'themes' => 'array|nullable',
            'themes.*' => 'numeric',
            'statuses' => 'array|nullable',
            'statuses.*' => 'numeric',
            'order_by_created_at' => 'string|nullable',
            'has_content' => 'boolean|nullable',
            'limit' => 'array|nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validated = $validator->validated();
        $bloggers = Blogger::where([]);

        if (isset($validated['statuses'])) {
            $bloggers->whereHas('user', function (Builder $query) use ($validated) {
                $query->whereIn('status', array_values($validated['statuses']));
            });
        }

        if (!empty($validated['name'])) {
            $bloggers = $bloggers->whereHas('user', function (Builder $query) use ($validated) {
                $query->where('name', 'like', '%' . $validated['name'] . '%');
            });
        }

        if (Auth::user()->role !== 'admin') {
            $bloggers->whereHas('platforms', function (Builder $query) use ($validated) {
                $query->where('coverage', '>=', 2000);
            });
        }

        if (!empty($validated['subscriber_quantity_min'])) {
            $bloggers->whereHas('platforms', function (Builder $query) use ($validated) {
                $query->where('subscriber_quantity', '>=', $validated['subscriber_quantity_min']);
            });
        }

        if (!empty($validated['subscriber_quantity_max'])) {
            $bloggers->whereHas('platforms', function (Builder $query) use ($validated) {
                $query->where('subscriber_quantity', '<=', $validated['subscriber_quantity_max']);
            });
        }

        if (!empty($validated['themes'])) {
            $bloggers->whereHas('themes', function (Builder $query) use ($validated) {
                $query->whereIn('theme_id', $validated['themes']);
            });
        }

        if (!empty($validated['platform'])) {
            $bloggers->whereHas('platforms', function (Builder $query) use ($validated) {
                $query->where('platform_id', $validated['platform']);
            });
        }

        if (!empty($validated['city'])) {
            $bloggers->where('city', $validated['city']);
        }

        if (!empty($validated['country'])) {
            $bloggers->whereHas('country', function (Builder $query) use ($validated) {
                $query->where('id', $validated['country']);
            });
        }

        if (!empty($validated['has_content'])) {
            $bloggers->has('content');
        }

        if (!empty($validated['sex'])) {
            $bloggers->whereIn('sex', $validated['sex']);
        }

        if (isset($validated['order_by_created_at']) && !empty($validated['order_by_created_at'])) {
            $bloggers->orderBy('created_at', $validated['order_by_created_at']);
        } else {
            $bloggers->orderBy('created_at', 'desc');
        }

        if (isset($validated['limit']) && !empty($validated['limit'])) {
            $bloggers->skip($validated['limit'][0])->take($validated['limit'][1]);
        }

        $data = [
            'bloggers' => BloggerResource::collection($bloggers->get()),
            'platform_fields' => BloggerPlatform::getFields(),
        ];

        return response()->json($data)->setStatusCode(200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'string|nullable',
            'sex' => 'required|string',
            'city' => 'required|string',
            'country_id' => 'required|numeric',
            'image' => 'image|required',
            'platforms' => 'array|required',
            'themes' => 'required|array',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();
        $validated = $validator->validated();

        $is_platform = false;

        foreach ($validated['platforms'] as $blogger_platform) {
            $platform = json_decode($blogger_platform, true);

            if (isset($platform['link']) && !empty($platform['link'])) {
                $is_platform = true;
                break;
            }
        }

        if (!$is_platform) {
            return response()->json(['message' => 'Укажите хотя бы одну соц сеть'], 400);
        }

        $blogger = Blogger::create([
            'user_id' => $user->id,
            'city' => $validated['city'],
            'country_id' => $validated['country_id'],
            'description' => $validated['description'] ?? null,
            'sex' => $validated['sex'],
        ]);

        foreach ($validated['platforms'] as $blogger_platform) {
            $platform = json_decode($blogger_platform, true);

            if (!empty($platform['link'])) {
                BloggerPlatform::create([
                    'blogger_id' => $blogger->id,
                    'platform_id' => $platform['platform_id'],
                    'link' => $platform['link'],
                ]);
            }
        }

        if ($request->file('image')) {
            $blogger_image = $request->file('image');
            $urls = ImageService::makeCompressedCopies($blogger_image, 'profile/' . $user->id . '/');

            $user->image = $urls[1];
            $user->save();
        }

        foreach ($validated['themes'] as $theme_id) {
            BloggerTheme::create([
                'blogger_id' => $blogger->id,
                'theme_id' => (int)$theme_id,
            ]);
        }

        TgService::sendModeration($user->name . ' оставил заявку на модерацию');
        return response()->json([])->setStatusCode(200);
    }

    public function show(Blogger $blogger)
    {
        $data = [
            'blogger' => new BloggerResource($blogger),
            'platform_fields' => BloggerPlatform::getFields(),
        ];

        return response()->json($data)->setStatusCode(200);
    }

    public function accept(Blogger $blogger, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'is_achievement' => 'boolean|nullable',
            'gender_ratio' => 'required|numeric',
            'platforms' => 'array|required',
            'platforms.*.link' => 'string|nullable',
            'platforms.*.subscriber_quantity' => 'numeric|nullable',
            'platforms.*.coverage' => 'numeric|nullable',
            'platforms.*.engagement_rate' => 'numeric|nullable',
            'platforms.*.cost_per_mille' => 'numeric|nullable',
            'platforms.*.additional_coverage' => 'numeric|nullable',
            'platforms.*.additional_engagement_rate' => 'numeric|nullable',
            'platforms.*.platform_id' => 'numeric|exists:platforms,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validated = $validator->validated();

        $is_platform = false;
        foreach ($validated['platforms'] as $platform) {
            if (isset($platform['link']) && !empty($platform['link'])) {
                $is_platform = true;
                break;
            }
        }

        if (!$is_platform) {
            return response()->json(['message' => 'Укажите хотя бы одну соц сеть'], 400);
        }

        $blogger->update([
            'is_achievement' => isset($validated['is_achievement']) ? $validated['is_achievement'] : false,
            'gender_ratio' => $validated['gender_ratio'],
        ]);

        foreach ($validated['platforms'] as $blogger_platform) {
            if (empty($blogger_platform) || empty($blogger_platform['platform_id'])) {
                continue;
            }

            $platform = $blogger->platforms()->where('platform_id', $blogger_platform['platform_id'])->first();
            if (isset($blogger_platform['link']) && !empty($blogger_platform['link'])) {
                if ($platform) {
                    $platform->update([
                        'link' => $blogger_platform['link'] ?? null,
                        'subscriber_quantity' => $blogger_platform['subscriber_quantity'] ?? null,
                        'coverage' => $blogger_platform['coverage'] ?? null,
                        'additional_coverage' => $blogger_platform['additional_coverage'] ?? null,
                        'engagement_rate' => $blogger_platform['engagement_rate'] ?? null,
                        'additional_engagement_rate' => $blogger_platform['additional_engagement_rate'] ?? null,
                        'cost_per_mille' => $blogger_platform['cost_per_mille'] ?? null,
                    ]);
                } else {
                    BloggerPlatform::create([
                        'blogger_id' => $blogger->id,
                        'platform_id' => $blogger_platform['platform_id'],
                        'link' => $blogger_platform['link'] ?? null,
                        'subscriber_quantity' => $blogger_platform['subscriber_quantity'] ?? null,
                        'coverage' => $blogger_platform['coverage'] ?? null,
                        'additional_coverage' => $blogger_platform['additional_coverage'] ?? null,
                        'engagement_rate' => $blogger_platform['engagement_rate'] ?? null,
                        'additional_engagement_rate' => $blogger_platform['additional_engagement_rate'] ?? null,
                        'cost_per_mille' => $blogger_platform['cost_per_mille'] ?? null,
                    ]);
                }
            } elseif ((!isset($blogger_platform['link']) || empty($blogger_platform['link'])) && $platform) {
                $platform->delete();
            }
        }

        $user = $blogger->user;
        $password = Str::random(15);
        $user->password = bcrypt($password);
        $user->save();

        $token = $user->createToken('Bearer');

        TgService::sendModerationMessage($user->status, $user->phone, $password, $token->plainTextToken, $user->tgPhone->chat_id);
        return response()->json('success', 200);
    }

    public function update(Blogger $blogger, Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required|min:3',
            'email' => 'email|nullable',
            'image' => 'image|nullable',
            'old_password' => 'min:8|nullable',
            'password' => 'min:8|nullable',
            'country_id' => 'required|exists:countries,id',
            'description' => 'string|nullable',
            'sex' => 'required|string',
            'city' => 'required|string',
            'themes' => 'array|nullable',
            'from_moderation' => 'boolean|nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors())->setStatusCode(400);
        }

        $validated = $validator->validated();

        if (isset($validated['from_moderation']) && $validated['from_moderation'] && empty($validated['image'])) {
            return response()->json(['image' => 'Необходимо загрузить изображение'])->setStatusCode(400);
        }

        $user = $blogger->user;
        if (isset($validated['password'])) {
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

        if (!empty($validated['name']) && $user->name != $validated['name']) {
            $user->name = $validated['name'];
        }

        if (isset($validated['email']) && $user->email != $validated['email']) {
            $user->email = $validated['email'];
        }

        if (isset($validated['from_moderation']) && $validated['from_moderation']) {
            $user->status = 1;
        }

        if ($request->file('image')) {
            if (Storage::exists($user->getImageURL())) {
                Storage::delete($user->getImageURL());
            }

            $blogger_image = $request->file('image');
            $urls = ImageService::makeCompressedCopies($blogger_image, 'profile/' . $user->id . '/');

            $user->image = $urls[1];
        }

        $user->save();

        $blogger->country_id = $validated['country_id'];
        $blogger->city = $validated['city'];
        $blogger->sex = $validated['sex'];

        if (!empty($validated['description']) && $validated['description'] !== 'null') {
            $blogger->description = $validated['description'];
        }

        if (!empty($validated['themes'])) {
            $blogger->themes()->delete();
            foreach ($validated['themes'] as $theme_id) {
                BloggerTheme::create([
                    'blogger_id' => $blogger->id,
                    'theme_id' => (int)$theme_id,
                ]);
            }
        }

        $blogger->save();

        $data = [
            'blogger' => new BloggerResource($blogger),
            'platform_fields' => BloggerPlatform::getFields(),
        ];

        return response()->json($data)->setStatusCode(200);
    }

    public function getContent(Blogger $blogger): JsonResponse
    {
        return response()->json(BloggerContentResource::collection($blogger->content))->setStatusCode(200);
    }

    public function setContent(Blogger $blogger): JsonResponse
    {
        $validator = Validator::make(request()->all(), [
            'videos' => 'array|required',
            'videos.*' => 'mimes:mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts|max:100040|required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors())->setStatusCode(400);
        }

        $user_id = $blogger->user_id ?? Auth::user()->id;

        $product_images = request()->file('videos');
        $blogger_content = [];
        foreach ($product_images as $key => $product_image) {
            $blogger_content[] = BloggerContent::create([
                'user_id' => $user_id,
                'path' => VideoService::save($product_image, 'profile/' . $user_id . '/content'),
            ]);
        }

        return response()->json(BloggerContentResource::collection($blogger_content))->setStatusCode(200);
    }

    /**
     * @throws ValidationException
     */
    public function deleteContent(): JsonResponse
    {
        $validator = Validator::make(request()->all(), [
            'videos' => 'array|required',
            'videos.*' => 'numeric|required|exists:blogger_contents,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors())->setStatusCode(400);
        }

        $validated = $validator->validated();

        foreach ($validated['videos'] as $video_id) {
            $content = BloggerContent::find($video_id);
            if (Storage::exists('public/' . $content->path)) {
                Storage::delete('public/' . $content->path);
            }
            $content->delete();
        }

        return response()->json()->setStatusCode(200);
    }
}
