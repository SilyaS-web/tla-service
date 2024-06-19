<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function view(Notification $notification) {
        $notification->viewed_at = date('Y-m-d H:i');
        $notification->save();

        return response()->json("success", 200);
    }
}
