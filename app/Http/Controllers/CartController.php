<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function index()
    {

        $cart = Cart::with('product')->where('id', $this->getCartId())
            ->orWhere('user_id', Auth::id())->get();

        $sub_total = $cart->sum(function($item) {
            return $item->quantity * $item->product->final_price;
        });

        $tax_ratio = 14;
        $tax = $sub_total * $tax_ratio / 100;
        $total = $sub_total + $tax;

        return view('cart', [
            'items' => $cart,
            'sub_total' => $sub_total,
            'tax' => $tax,
            'total' => $total,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['int', 'min:1'],
        ]);

        /*$cart = Cart::where([
            'id' => $this->getCartId(),
            'product_id' => $request->post('product_id'),
        ])->first();

        if ($cart) {
            Cart::where([
                'id' => $this->getCartId(),
                'product_id' => $request->post('product_id'),
            ])->update([
                'quantity' => $cart->quantity + $request->post('quantity', 1),
            ]);

        } else {

            $cart = Cart::create([
                'id' => $this->getCartId(),
                'product_id' => $request->post('product_id'),
                'quantity' => $request->post('quantity', 1),
                'user_id' => Auth::id(),
            ]);
        }*/

        $cart = Cart::updateOrCreate([
            'id' => $this->getCartId(),
            'product_id' => $request->post('product_id'),
        ], [
            'quantity' => DB::raw('quantity + ' . $request->post('quantity', 1)),
            'user_id' => Auth::id(),
        ]);

        $name = $cart->product->name;

        if ($request->expectsJson()) {
            return Cart::with('product')->where('id', $this->getCartId())
            ->orWhere('user_id', Auth::id())->get();
        }

        return redirect()->back()->with('status', "Product $name added to cart");

        //$product = Product::findOrFail($request->post('product_id'));
        //return redirect()->back()->with('status', "Product $product->name added to cart");
    }

    public function update(Request $request)
    {
        $request->validate([
            'quantity' => ['required', 'array'],
        ]);

        $that = $this;
        foreach ($request->post('quantity') as $product_id => $quantity) {
            Cart::where('product_id', $product_id)
                ->where(function($query) use ($that) {
                    $query->where('id', '=', $that->getCartId())
                        ->orWhere('user_id', '=', Auth::id());
                })->update([
                    'quantity' => $quantity,
                ]);
        }

        return redirect()->back()->with('status', "Cart updated");
    }

    public function destroy()
    {
        Cart::where('id', '=', $this->getCartId())->orWhere('user_id', Auth::id())->delete();
        $cookie = Cookie::make('cart_id', '', -60);
        return redirect()->back()->with('status', "Cart cleared")->cookie($cookie);
    }

    protected function getCartId()
    {
        $id = request()->cookie('cart_id');
        if (!$id) {
            $id = Str::uuid();
            Cookie::queue('cart_id', $id, 60 * 24 * 7);
        }
        return $id;
    }
}
