<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StatsRequest;
use App\Models\Project;
use App\Models\User;
use App\Models\Work;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function stats(StatsRequest $request)
    {
        $validated = $request->validated();

        $collections = [
            [
                'report_fields' => [
                    [
                        'name' => 'Блогеров всего',
                        'rules' => [['role', 'blogger']]
                    ],
                    [
                        'name' => 'Блогеров заблокировано',
                        'rules' => [['status', -1], ['role', 'blogger']]
                    ],
                    [
                        'name' => 'Блогеров одобрено',
                        'rules' => [['role', 'blogger'], ['status', 1]]
                    ],
                    [
                        'name' => 'Селлеров всего',
                        'rules' => [['role', 'seller']]
                    ],
                    [
                        'name' => 'Селлеров заблокировано',
                        'rules' => [['role', 'seller'], ['status', -1]]
                    ],
                    [
                        'name' => 'Агентов всего',
                        'rules' => [['role', 'seller'], ['is_agent', 1]]
                    ]
                ],
                'query' => User::where([])
            ],
            [
                'report_fields' => [
                    [
                        'name' => 'Всего проектов',
                        'rules' => null
                    ],
                    [
                        'name' => 'Опубликовано проектов',
                        'rules' => [['is_blogger_access', 1], ['status', '>=', Project::ACTIVE]]
                    ],
                    [
                        'name' => 'Черновиков проектов',
                        'rules' => [['is_blogger_access', 0], ['status', '<>', Project::BANNED]]
                    ],
                    [
                        'name' => 'Заблокировано проектов',
                        'rules' => [['status', Project::BANNED]]
                    ],
                ],
                'query' => Project::where([]),
            ],
            [
                'report_fields' => [
                    [
                        'name' => 'Всего чатов',
                        'rules' => null
                    ],
                    [
                        'name' => 'Открыто сейчас чатов',
                        'rules' => [['status', Work::PENDING]]
                    ],
                    [
                        'name' => 'Успешных сделок',
                        'rules' => [['status', Work::COMPLETED]]
                    ],
                    [
                        'name' => 'Отменённых сделок',
                        'rules' => [['status', Work::CANCELED]]
                    ],
                ],
                'query' => Work::where([])
            ],
        ];

        $report = [];
        foreach ($collections as $collection) {
            $query = $collection['query'];

            if (!empty($validated['start'])) {
                $query->whereDate('created_at', '>=', $validated['start']);
            }

            if (!empty($validated['end'])) {
                $query->whereDate('created_at', '<=', $validated['end']);
            }

            $items = $query->get();

            foreach ($collection['report_fields'] as $report_field) {
                $filtered = $items;

                if (!empty($report_field['rules'])) {
                    foreach ($report_field['rules'] as $rule) {
                        $filtered = $filtered->where(...$rule);
                    }
                }

                $report[$report_field['name']] = $filtered->count();
            }
        }

        return response()->json(['report' => $report]);
    }
}
