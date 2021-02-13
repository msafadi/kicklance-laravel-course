<?php

namespace App\Http\Controllers;

use App\Events\OrderCreated;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use App\Notifications\OrderCreatedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Throwable;

class CheckoutController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store(Request $request)
    {
        $user = $request->user();
        $user_id = $user->id;
        $products = Cart::with('product')
            ->where('user_id', $user_id)
            ->orWhere('id', $request->cookie('cart_id'))
            ->get();

        if (!$products) {
            return redirect()->route('cart');
        }

        $total = $products->sum(function($item) {
            return $item->product->final_price * $item->quantity;
        });

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => $user_id,
                'total' => $total,
            ]);

            foreach ($products as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->final_price,
                ]);
            }

            /*Cart::where('user_id', $user_id)
                ->orWhere('id', $request->cookie('cart_id'))
                ->delete();*/

            DB::commit();

            //event(new OrderCreated($order));
            $user->notify(new OrderCreatedNotification($order));

            // SELECT * from users where type in ('admin', 'super-admin')
            $users = User::whereIn('type', ['super-admin', 'admin'])->get();
            Notification::send($users, new OrderCreatedNotification($order));

            return redirect()->route('orders')->with('success', 'Order created');

        } catch (Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
        
    }
}
