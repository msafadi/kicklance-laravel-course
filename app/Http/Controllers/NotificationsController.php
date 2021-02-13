<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function read($id)
    {
        $user = Auth::user();
        $notification = $user->notifications()->findOrFail($id);
        //$user->notifications->markAsRead();
        $notification->markAsUnead();

        return redirect()->to($notification->data['action']);
    }
}
