<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderFile;
use App\Models\User;
use App\Models\Work;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Nyholm\Psr7\UploadedFile;

class OrderService
{
    public static function create(array $order_data, array $files, User $user, string $status = Order::PENDING): Order
    {
        $work = Work::query()->find($order_data['work_id']);
        $project = $work->project;
        $order_data['status'] = $status;
        $order_data['complete_till'] = Carbon::now()->addDays($order_data['complete_till'])->toDateTimeString();
        $order = Order::create($order_data);
        $user->balance -= $order_data['price'];
        $user->save();

        if (!empty($files)) {
            foreach ($files as $file) {
                $file_path = $file->storeAs('orders', $order->id . '_' . Carbon::now()->format('Y_m_d') . '_' . $file->hashName(), 'public');

                OrderFile::create([
                    'source_id' => $order->id,
                    'type' => 0,
                    'link' => $file_path,
                ]);
            }
        }

        NotificationService::send('Вам поступил заказ на проект ' . $project->product_name, $user->role, $work);
        return $order;
    }

    public static function accept(Order $order, User $user): void
    {
        $order->update(['status' => Order::ACCEPTED]);
        $work = $order->work;
        $project = $work->project;
        NotificationService::send($user->name . ' принял заказ на проект ' . $project->product_name, $user->role, $work);
    }

    public static function reject(Order $order, User $user): void
    {
        $user->balance += $order->price;
        $user->save();
        $order->update(['status' => Order::REJECTED]);
        $work = $order->work;
        $project = $work->project;
        NotificationService::send($user->name . ' отклонил заказ на проект ' . $project->product_name, $user->role, $work);
    }

    public static function complete(Order $order, User $seller_user): void
    {
        $work = $order->work;
        $blogger_user = $work->getPartnerUser($seller_user->role);
        $blogger_user->balance += $order->price;
        $blogger_user->save();
        $order->update(['status' => Order::COMPLETED]);
        $project = $work->project;
        NotificationService::send('Селлер отметил заказ на проект ' . $project->product_name, $seller_user->role, $work);
    }

    public static function destroy(Order $order): void
    {
        $order->delete();
    }
}
