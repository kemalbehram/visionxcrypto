<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OthersController extends Controller
{
    public function readNotifications(){
        $user=User::find(Auth::id());

        foreach ($user->unreadNotifications as $notification) {
            $notification->markAsRead();
        }

        return response()->json(['status' => 1, 'message' => 'Notifications read successfully']);
    }
}
