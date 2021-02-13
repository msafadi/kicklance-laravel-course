<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $orders = $user->orders;

        return view('orders.index', [
            'orders' => $orders,
        ]);
    }

    public function show(Order $order)
    {
        //$user = Auth::user();
        //$order = $user->orders()->findOrFail($id);
        if (Auth::id() != $order->user_id) {
            abort(404);
        }
        return view('orders.show', [
            'order' => $order,
        ]);
    }
}
