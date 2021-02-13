<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class IndexController extends Controller
{
    // Actions
    public function index()
    {
        //Cookie::queue('cart_id', '', -60);
        $products = Product::with('category')
            //->where('status', 'published')
            //->featured()
            //->popular(1000, 50)
            ->withCount([
                'favouriteUsers as favourite' => function($query) {
                    $query->where('id', '=', Auth::id());
                }
            ])
            ->latest()->limit(6)->get();

        return view('home', [
            'products' => $products,
        ]);
    }

    public function show($id)
    {
        $product = Product::where('status', 'published')->findOrFail($id);
        return $product;
    }
}
