<?php

namespace App\Http\Controllers;

use App\Models\Blogger;
use App\Models\Project;
use App\Models\ProjectFile;
use App\Models\ProjectWork;
use App\Models\Theme;
use App\Models\User;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class ProjectController extends Controller
{

    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_type' => [Rule::in(Project::TYPES), 'nullable'],
            'project_name' => 'string|nullable',
            'type' => 'string|nullable'
        ]);

        if ($validator->fails()) {
            $projects = [];
            return view("project.index", compact('projects'));
        }

        $validated = $validator->validated();
        $user = Auth::user();

        $filter = [];

        if (isset($validated['project_name']) && !empty($validated['project_name'])) {
            $filter[] = ['product_name', 'like', '%' . $validated['project_name'] . '%'];
        }

        $projects = $user->projects()->where($filter)->withCount(['works' => function (Builder $query) {
            $query->where('status', 1);
        }]);

        if (isset($validated['project_type']) && !empty($validated['project_type'])) {
            $projects->whereHas('projectWorks', function (Builder $query) use ($validated) {
                $query->where('type', $validated['project_type']);
            });
        }

        if ($user->role == 'blogger') {
            $works = Work::where([['blogger_id', $user->id]])->get();
            $projects->whereIn('id', $works->pluck('project_id'))->get();
            $projects = $projects->get();
            return view("project.blogger-list", compact('projects'));
        }

        $projects = $projects->get();

        if ($validated['type'] == 'select-project-page') {
            return view('project.seller-list', compact('projects'));
        }

        return view("project.index", compact('projects'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'feedback-quantity' => 'numeric|nullable',
            'inst-quantity' => 'numeric|nullable',
            'product_name' => 'required|min:3|max:250',
            'product_nm' => 'required|min:3|numeric',
            'product_link' => 'required|min:3|max:1000',
            'product_price' => 'required|numeric',
            'images' => 'required|array',
            'images.*' => 'image|max:10240',
        ]);

        if ($validator->fails()) {
            return redirect()->route('profile')->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();
        if ((!isset($validated['feedback-quantity']) || $validated['feedback-quantity'] < 1) && (!isset($validated['inst-quantity']) || $validated['inst-quantity'] < 1)) {
            return redirect()->route('profile')->with('success', 'Количество видов рекламы не было выбрано')->with('switch-tab', 'create-project')->withInput();
        }

        $user = Auth::user();
        $validated['seller_id'] = $user->id;
        if (strripos($validated['product_link'], 'ozon') !== false && !empty($user->seller->ozon_client_id) && !empty($user->seller->ozon_api_key)) {
            $info = $this->getOzonInfo($validated['product_nm'], $user->seller->ozon_client_id, $user->seller->ozon_api_key);
            if (isset($info['name'])) {
                $validated['ozon_category'] = $info['category'];
                $validated['ozon_brand'] = $info['brand'];
                $validated['ozon_product_name'] = $info['name'];
                $validated['ozon_description'] = $info['description'];
                $validated['ozon_options'] = json_encode($info['options']);
            }
        } else {
            $card = $this->curlWBStats($validated['product_nm']);
            if ($card) {
                $validated['wb_category'] = $card->subj_name;
                $validated['wb_product_name'] = $card->imt_name;
                $validated['wb_description'] = $card->description;
                $validated['wb_options'] = json_encode($card->options);
            }
        }

        $validated['status'] = Project::ACTIVE;
        $project = Project::create($validated);

        if (isset($validated['feedback-quantity']) && $validated['feedback-quantity'] > 0) {
            ProjectWork::create([
                'type' => Project::FEEDBACK,
                'quantity' => $validated['feedback-quantity'],
                'project_id' => $project->id,
            ]);
        }

        if (isset($validated['inst-quantity']) && $validated['inst-quantity'] > 0) {
            ProjectWork::create([
                'type' => Project::INSTAGRAM,
                'quantity' => $validated['inst-quantity'],
                'project_id' => $project->id,
            ]);
        }

        $product_images = $request->file('images');
        foreach ($product_images as $product_image) {
            $image_path = $product_image->store('projects', 'public');
            ProjectFile::create([
                'source_id' => $project->id,
                'type' => 0,
                'link' => $image_path,
            ]);
        }

        return redirect()->route('profile')->with('success', 'Проект успешно создан')->with('switch-tab', 'create-project');
    }

    public function selectBloggers($project_id)
    {
        $project = Project::find($project_id);
        $bloggers = Blogger::get();
        return view('seller.select-blogger', compact('project', 'bloggers'));
    }

    public function bloggerProjects(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $role = $user->role;

        $validator = Validator::make(request()->all(), [
            'project_name' => 'string|nullable',
            'project_type' => 'string|nullable',
            'category' => 'string|nullable',
            'type' => 'string|nullable'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = Auth::user();
        $validated = $validator->validated();
        $type = $validated['type'] ?? null;

        if (isset($validated['type']) && $validated['type'] == 'applications') {
            $application_works = Work::where([['blogger_id', $user_id]])->where('created_by', '<>', $user_id)->where('accepted_by_blogger_at', null);

            if (isset($validated['project_type']) && !empty($validated['project_type'])) {
                $application_works->whereHas('projectWork', function (Builder $query) use ($validated) {
                    $query->where('type', $validated['project_type']);
                });
            }

            if (isset($validated['project_name']) && !empty($validated['project_name'])) {
                $application_works->whereHas('project', function (Builder $query) use ($validated) {
                    $query->where('product_name', 'like', '%' . $validated['project_name'] . '%');
                });
            }

            if (isset($validated['category']) && !empty($validated['project_name'])) {
                $application_works->whereHas('project', function (Builder $query) use ($validated) {
                    $query->where('wb_category', 'like', '%' . $validated['category'] . '%');
                });
            }

            $project_works = $application_works->get();
            $type = 'applications';
            return view('project.blogger-list', compact('project_works', 'role', 'user_id', 'type'));
        }

        $works = Work::where([['blogger_id', $user_id]]);

        if (isset($validated['type']) && $validated['type'] == 'works') {
            $works->where('status', Work::IN_PROGRESS);
        }

        $works = $works->get();
        $project_works = ProjectWork::whereIn('id', $works->pluck('project_work_id'));
        $project_works->whereHas('project', function (Builder $query) {
            $query->where('status', '<>', Project::BANNED)->where('is_blogger_access', true);
        });

        if (isset($validated['project_type']) && !empty($validated['project_type'])) {
            $project_works->where('type', $validated['project_type']);
        }

        if (isset($validated['project_name']) && !empty($validated['project_name'])) {
            $project_works->whereHas('project', function (Builder $query) use ($validated) {
                $query->where('product_name', 'like', '%' . $validated['project_name'] . '%');
            });
        }

        if (isset($validated['category']) && !empty($validated['project_name'])) {
            $project_works->whereHas('project', function (Builder $query) use ($validated) {
                $query->where('wb_category', 'like', '%' . $validated['category'] . '%');
            });
        }

        $project_works = $project_works->get();
        return view('project.blogger-list', compact('project_works', 'type'));
    }

    public function show(Project $project)
    {
        return view('project.show', compact('project'));
    }

    public function edit(Project $project)
    {
        return view('project.edit', compact('project'));
    }

    public function update(Project $project)
    {
        $validator = Validator::make(request()->all(), [
            'product_name' => 'required|min:3|max:250',
            'product_nm' => 'required|min:3|numeric',
            'product_link' => 'required|min:3|max:250',
            'product_price' => 'required|numeric',
            // 'images' => 'required|array',
            // 'images.*' => 'image|max:10240',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        foreach ($project->projectFiles as $file) {
            Storage::delete($file->link);
        }

        $project->update($validated);

        return redirect()->back()->with('success', 'Проект успешно обновлён');
    }
    public function destroy($id)
    {
        if ($project = Project::find($id)) {
            $project->delete();
            return redirect()->route('profile')->with('success', 'Проект успешно удалён');
        }

        return redirect()->route('profile')->with('success', 'Произошла ошибка при удалении проекта');
    }

    public function activate(Project $project)
    {
        $project->update(['is_blogger_access' => true]);
        return redirect()->route('profile')->with('switch-tab', 'profile-projects')->with('success', 'Проект успешно выложен');
    }

    public function ban(Project $project)
    {
        $project->update(['status' => Project::BANNED]);
        return redirect()->route('profile')->with('switch-tab', 'projects-list');
    }

    public function unban(Project $project)
    {
        $project->update(['status' => Project::ACTIVE]);
        return redirect()->route('profile')->with('switch-tab', 'projects-list');
    }

    public function categories()
    {
        $validator = Validator::make(request()->all(), [
            'category' => 'string|nullable',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validated = $validator->validated();
        $categories = [];

        if (isset($validated['category']) && !empty($validated['category'])) {
            $categories = Project::selectRaw('wb_category as theme')->where('wb_category', 'like', '%' . $validated['category'] . '%')->distinct('wb_category')->get();
        }

        return response()->json(['categories' => $categories], 200);
    }

    public function getWBInfo(Project $project)
    {
        $total_quantity = $project->projectWorks()->sum('quantity');
        $lost_quantity = $total_quantity - $project->works()->where('status', '<>', null)->count();
        $options = [];
        if (!empty($project->wb_options)) {
            $options = json_decode($project->wb_options);
        } else if (!empty($project->ozon_options)) {
            $options = json_decode($project->ozon_options);
        }
        return response()->json([
            'category' => $project->wb_category ?? $project->ozon_category,
            'product_name' => $project->wb_product_name ?? $project->ozon_product_name,
            'description' => $project->wb_description ?? $project->ozon_description,
            'total_quantity' => $total_quantity,
            'lost_quantity' => $lost_quantity,
            'product_code' => $project->product_nm,
            'price' =>  $project->product_price,
            'images' => $project->getImageURL(),
            'optioins' => $options,
        ], 200);
    }

    public function curlWBStats(int $product_nm)
    {
        $r = $product_nm;
        $n = ~~($r / 1e5);
        $a = ~~($r / 1e3);
        $o = $this->getHost($n);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://$o/vol$n/part$a/$r/info/ru/card.json");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // if ($http_code != 200) {
        //     return false;
        // }

        $card = json_decode($response);
        return $card;
    }

    public function getHost($e)
    {
        $t = "01";
        switch (!0) {
            case $e >= 0 && $e <= 143:
                $t = "01";
                break;
            case $e >= 144 && $e <= 287:
                $t = "02";
                break;
            case $e >= 288 && $e <= 431:
                $t = "03";
                break;
            case $e >= 432 && $e <= 719:
                $t = "04";
                break;
            case $e >= 720 && $e <= 1007:
                $t = "05";
                break;
            case $e >= 1008 && $e <= 1061:
                $t = "06";
                break;
            case $e >= 1062 && $e <= 1115:
                $t = "07";
                break;
            case $e >= 1116 && $e <= 1169:
                $t = "08";
                break;
            case $e >= 1170 && $e <= 1313:
                $t = "09";
                break;
            case $e >= 1314 && $e <= 1601:
                $t = "10";
                break;
            case $e >= 1602 && $e <= 1655:
                $t = "11";
                break;
            case $e >= 1656 && $e <= 1919:
                $t = "12";
                break;
            case $e >= 1920 && $e <= 2045:
                $t = "13";
                break;
            case $e >= 2046 && $e <= 2189:
                $t = "14";
                break;
            case $e >= 2090 && $e <= 2405:
                $t = "15";
                break;
            case $e >= 2406 && $e <= 2621:
                $t = "16";
                break;
            default:
                $t = "17";
        }
        return "basket-$t.wbbasket.ru";
    }


    public function getOzonInfo(int $product_nm, int $client_id, string $api_key)
    {
        $card = $this->getOzonGeneralInfo($product_nm, $client_id, $api_key);
        $product_attributes_without_names = $this->getOzonProductAttributestInfo($product_nm, $client_id, $api_key);
        $attributes = $this->getOzonAttributestInfo($card->description_category_id, $card->type_id, $client_id, $api_key);
        $product_attributes = [];
        $product_brand = '';

        foreach ($product_attributes_without_names as $product_attribute) {
            foreach ($attributes as $attribute) {
                if ($attribute->id == $product_attribute->attribute_id && is_string($product_attribute->values[0]->value)) {
                    $product_attributes[] = [
                        'name' => $attribute->name,
                        'value' => $product_attribute->values[0]->value,
                    ];

                    if ($attribute->name == 'Бренд') {
                        $product_brand = $product_attribute->values[0]->value;
                    }

                    break;
                }
            }
        }
        $product_description = $this->getOzonProductDescription($product_nm, $client_id, $api_key);

        return [
            'name' => $card->name,
            'brand' => $product_brand,
            'category' => '',
            'options' => $product_attributes,
            'description' => $product_description,
        ];
    }


    public function getOzonGeneralInfo(int $product_nm, int $client_id, string $api_key)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-seller.ozon.ru/v2/product/info',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "product_id": ' . $product_nm . '
            }',
            CURLOPT_HTTPHEADER => array(
                'Api-Key: ' . $api_key,
                'Client-Id: ' . $client_id,
                'Content-Type: application/json',
                'Cookie: abt_data=b89761760b8de852bf55c8ddb5c67e8d:832e12896ab719f7407396c381b35f3a3d643bbfa0faf7dc57be5fa479853d4abf58774b252ef432ca7222519c8c820723fbec410cfd0621dce2aa17bb312ad413cb085f1861a4f3740e3762e4d6ae0614e33e4c098957a50fd58f0af0978798359d6d40d544c115a7ab52adf63d59debd62021596171bf292470486511a05fb80c63d1c1b372b051eb5508704cdfd2479451d755c1f861efc363f5760900b1a40b1cf1f2d759ad9936fca12bfed8abd'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $card = json_decode($response)->result;

        return $card;
    }

    public function getOzonProductAttributestInfo(int $product_nm, int $client_id, string $api_key)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-seller.ozon.ru/v3/products/info/attributes',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "filter" : {
                    "product_id": ["' . $product_nm . '"]
                },
                "limit": 1
            }',
            CURLOPT_HTTPHEADER => array(
                'Api-Key: ' . $api_key,
                'Client-Id: ' . $client_id,
                'Content-Type: application/json',
                'Cookie: abt_data=b89761760b8de852bf55c8ddb5c67e8d:832e12896ab719f7407396c381b35f3a3d643bbfa0faf7dc57be5fa479853d4abf58774b252ef432ca7222519c8c820723fbec410cfd0621dce2aa17bb312ad413cb085f1861a4f3740e3762e4d6ae0614e33e4c098957a50fd58f0af0978798359d6d40d544c115a7ab52adf63d59debd62021596171bf292470486511a05fb80c63d1c1b372b051eb5508704cdfd2479451d755c1f861efc363f5760900b1a40b1cf1f2d759ad9936fca12bfed8abd'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $attributes = json_decode($response)->result[0]->attributes;

        return $attributes;
    }

    public function getOzonAttributestInfo(int $description_category_id, int $type_id, int $client_id, string $api_key)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-seller.ozon.ru/v1/description-category/attribute',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "description_category_id": ' . $description_category_id . ',
                "type_id": ' . $type_id . '
            }',
            CURLOPT_HTTPHEADER => array(
                'Api-Key: ' . $api_key,
                'Client-Id: ' . $client_id,
                'Content-Type: application/json',
                'Cookie: abt_data=b89761760b8de852bf55c8ddb5c67e8d:832e12896ab719f7407396c381b35f3a3d643bbfa0faf7dc57be5fa479853d4abf58774b252ef432ca7222519c8c820723fbec410cfd0621dce2aa17bb312ad413cb085f1861a4f3740e3762e4d6ae0614e33e4c098957a50fd58f0af0978798359d6d40d544c115a7ab52adf63d59debd62021596171bf292470486511a05fb80c63d1c1b372b051eb5508704cdfd2479451d755c1f861efc363f5760900b1a40b1cf1f2d759ad9936fca12bfed8abd'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $attributes = json_decode($response)->result;

        return $attributes;
    }

    public function getOzonProductDescription(int $product_nm, int $client_id, string $api_key)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-seller.ozon.ru/v1/product/info/description',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "product_id": ' . $product_nm . '
            }',
            CURLOPT_HTTPHEADER => array(
                'Api-Key: ' . $api_key,
                'Client-Id: ' . $client_id,
                'Content-Type: application/json',
                'Cookie: abt_data=b89761760b8de852bf55c8ddb5c67e8d:832e12896ab719f7407396c381b35f3a3d643bbfa0faf7dc57be5fa479853d4abf58774b252ef432ca7222519c8c820723fbec410cfd0621dce2aa17bb312ad413cb085f1861a4f3740e3762e4d6ae0614e33e4c098957a50fd58f0af0978798359d6d40d544c115a7ab52adf63d59debd62021596171bf292470486511a05fb80c63d1c1b372b051eb5508704cdfd2479451d755c1f861efc363f5760900b1a40b1cf1f2d759ad9936fca12bfed8abd'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $description = json_decode($response)->result->description;
        return $description;
    }
}
