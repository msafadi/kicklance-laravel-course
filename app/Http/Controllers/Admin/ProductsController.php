<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductsController extends Controller
{

    public function __construct()
    {
        //$this->middleware('admin');
        //$this->middleware(UserType::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request = request();
        $filters = $request->query();
        
        /*$products = Product::query();
        if ($request->query('name')) {
            $products->where('name', 'LIKE', '%' . $request->query('name') . '%');
        }
        if ($request->query('price_min')) {
            $products->where('price', '>=', $request->query('price_min'));
        }
        if ($request->query('price_max')) {
            $products->where('price', '<=', $request->query('price_max'));
        }
        if ($request->query('category_id')) {
            $products->where('category_id', '=', $request->query('category_id'));
        }*/

        /*$products = Product::join('categories', 'categories.id', '=', 'products.category_id')
        ->select([
            'products.*',
            'categories.name as category_name',
        ])*/

        //Gate::authorize('products');
        $this->authorize('viewAny', Product::class);

        $products = Product::with('category', 'user')
            ->when($request->query('name'), function($query, $name) {
                $query->where('products.name', 'LIKE', '%' . $name . '%');
            })
            ->when($request->query('price_min'), function($query, $price) {
                $query->where('price', '>=', $price);
            })
            ->when($request->query('price_max'), function($query, $price) {
                $query->where('price', '<=', $price);
            })
            ->when($request->query('category_id'), function($query, $category_id) {
                $query->where('category_id', '=', $category_id);
            })
            //->withoutGlobalScope('published')
            ->withDraft()
            ->paginate();

        return view('admin.products.index', [
            'products' => $products,
            'filters' => $filters,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Gate::authorize('products.create');
        $this->authorize('create', Product::class);

        return view('admin.products.create', [
            'categories' => Category::all(),
            'product' => new Product(),
            'tags' => Tag::all(),
            'product_tags' => '',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Gate::authorize('products.create');
        $this->authorize('create', Product::class);

        $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'quantity' => 'int|min:0',
            'image' => 'nullable|mimes:jpg,jpeg,bmp,png|max:1024000',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            //$filename = $image->getClientOriginalName();
            //$ext = $image->getClientOriginalExtension();
            //$filename = 'product' . $ext;
            $data['image'] = $image->store('products', 'images');
        }

        $data['user_id'] = Auth::id(); // $request->user()->id // Auth::user()->id

        $product = Product::create($data);
        
        $this->saveTags($product, $request);
        
        //$tags = $request->post('tag', []);
        //$product->tags()->sync($tags);

        return redirect()
            ->route('admin.products.index')
            ->with('success', "Product ({$product->name}) created!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Gate::authorize('products');
        $product = Product::withDraft()->findOrFail($id);
        $this->authorize('view', $product);

        $tags = Tag::whereRaw('id IN (SELECT tag_id FROM product_tag WHERE product_id = ?)', [$id])->get();

        return view('admin.products.show', [
            'product' => $product,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Gate::authorize('products.edit');
        $product = Product::withDraft()->findOrFail($id);
        $this->authorize('update', $product);

        //$product_tags = $product->tags->pluck('id')->toArray();

        $product_tags = implode( ', ', $product->tags->pluck('name')->toArray() );

        return view('admin.products.edit', [
            'product' => $product,
            'categories' => Category::all(),
            'tags' => Tag::all(),
            'product_tags' => $product_tags,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Gate::authorize('products.edit');
        $product = Product::withDraft()->findOrFail($id);
        $this->authorize('update', $product);

        $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'quantity' => 'int|min:0',
            'image' => 'nullable|mimes:jpg,jpeg,bmp,png|max:1024000',
        ]);

        $old_image = $product->image;

        $data = $request->except('image');

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $data['image'] = $image->store('products', 'images');
        }

        $product->update($data);

        $this->saveTags($product, $request);
        //$tags = $request->post('tag', []);
        //$product->tags()->sync($tags);
        /*DB::table('product_tag')->where('product_id', $product->id)->delete();
        foreach($tags as $tag_id) {
            DB::table('product_tag')->insert([
                'product_id' => $product->id,
                'tag_id' => $tag_id
            ]);
        }*/

        if ($old_image && isset($data['image'])) {
            Storage::disk('images')->delete($old_image);
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', "Product ({$product->name}) updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Gate::authorize('products.delete');
        $product = Product::withDraft()->findOrFail($id);
        $this->authorize('delete', $product);
        $product->delete();
        /*if ($product->image) {
            Storage::disk('images')->delete($product->image);
        }*/

        return redirect()
            ->route('admin.products.index')
            ->with('success', "Product ({$product->name}) deleted!");
    }

    protected function saveTags(Product $product, Request $request)
    {
        $tags = explode(',',  $request->post('tags'));

        $tag_ids = [];

        foreach ($tags as $name) {
            $name = strtolower(trim($name));
            $tag = Tag::where('name', $name)->first();
            if (!$tag) {
                $tag = Tag::create([
                    'name' => $name
                ]);
            }
            $tag_ids[] = $tag->id;
        }

        $product->tags()->sync($tag_ids);
    }

    public function trash()
    {
        $products = Product::with('category')->withDraft()->onlyTrashed()->paginate();
        return view('admin.products.trash', [
            'products' => $products,
        ]);
    }

    public function restore(Request $request, $id)
    {
        $product = Product::onlyTrashed()->withDraft()->findOrFail($id);
        $product->restore();

        return redirect()
            ->route('admin.products.index')
            ->with('success', "Product ({$product->name}) restored!");
    }

    public function forceDelete($id)
    {
        $product = Product::onlyTrashed()->withDraft()->findOrFail($id);
        $product->forceDelete();
        /*if ($product->image) {
            Storage::disk('images')->delete($product->image);
        }*/
        return redirect()
            ->route('admin.products.index')
            ->with('success', "Product ({$product->name}) force deleted!");
    }
}
