<?php

namespace App\Services;

use App\Models\Order;
use App\Models\User;
use App\Models\Work;
use Carbon\Carbon;

class OrderService
{
    public static function create(array $order_data, User $user, string $status = Order::PENDING): Order
    {
        $work = Work::query()->find($order_data['work_id']);
        $project = $work->project;
        $order_data['status'] = $status;
        $order_data['complete_till'] = Carbon::now()->addDays($order_data['complete_till'])->toDateTimeString();
        $order = Order::create($order_data);
        $user->balance -= $order_data['price'];
        $user->save();

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
}
