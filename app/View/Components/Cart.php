<?php

namespace App\View\Components;

use App\Models\Cart as CartModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\View\Component;

class Cart extends Component
{

    public $items;

    public $total;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $cart = CartModel::with('product')->where('id', Cookie::get('cart_id'))
            ->orWhere('user_id', Auth::id())->get();

        $this->items = $cart;
        $this->total = $cart->sum(function($item) {
            return $item->quantity * $item->product->final_price;
        });
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.cart');
    }
}
