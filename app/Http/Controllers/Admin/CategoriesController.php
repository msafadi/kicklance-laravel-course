<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Rules\ParentRule;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        /*$categories = Category::leftJoin('categories as parents', 'parents.id', '=', 'categories.parent_id')
            ->leftJoin('products', 'products.category_id', '=', 'categories.id')
            ->select([
                'categories.id',
                'categories.name',
                'categories.parent_id',
                'categories.created_at',
                'categories.updated_at',
                'parents.name as parent_name',
                //DB::raw('count(products.id) as products_count')
            ])
            ->addSelect([
                'parents.id as parentid',
            ])
            ->selectRaw('count(products.id) as products_count')
            ->distinct()
            ->groupBy([
                'categories.id',
                'categories.name',
                'categories.parent_id',
                'categories.created_at',
                'categories.updated_at',
                'parent_name',
                'parentid',
            ])
            ->orderBy('products_count', 'DESC')
            ->orderBy('categories.name')
            ->paginate();*/

        if (Gate::denies('categories')) {
            abort(403, 'You are not allowed to view categories!');
        }

        $categories = Category::with('parent')
            ->withCount('products')
            ->latest()
            ->paginate();

        return view('admin.categories.index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*if (Gate::denies('categories.create')) {
            abort(403, 'You are not allowed to create category!');
        }*/
        Gate::authorize('categories.create');
        
        return view('admin.categories.create', [
            'categories' => Category::all(),
            'category' => new Category(),
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
        Gate::authorize('categories.create');
        $request->validate($this->rules());
        //$this->validate($request, $this->rules());

        //$validator = $this->validator($request);
        //$validator->validate();

        /*$category = new Category();
        $category->name = $request->post('name');
        $category->parent_id = $request->post('parent_id');
        $category->description = $request->post('description');
        $category->save();*/

        /*$category = Category::create([
            'name' =>  $request->post('name'),
            'parent_id' => $request->post('parent_id'),
            'description' => $request->post('description'),
        ]);*/

        $category = Category::create( $request->all() );

        return redirect('/admin/categories')
            ->with('success', "Category ($category->name) created");
            //->with('error', 'Some error message');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Gate::authorize('categories');
        $category = Category::find($id);
        if ($category == null) {
            abort(404);
        }
        dd( $category );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Gate::authorize('categories.update');
        $category = Category::findOrFail($id);
        $categories = Category::where('id', '<>', $id)
            ->where(function($query) use($id) {
                $query->where('parent_id', '<>', $id)
                      ->orWhereNull('parent_id');
            })
            ->get();

        return view('admin.categories.edit', [
            'categories' => $categories,
            'category' => $category,
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
        Gate::authorize('categories.update');
        $validator = $this->validator($request, $id);
        $validator->validate();

        $category = Category::findOrFail($id);

        /*$category->name = $request->post('name');
        $category->parent_id = $request->post('parent_id');
        $category->description = $request->post('description');
        $category->save();*/

        /*$category->update([
            'name' =>  $request->post('name'),
            'parent_id' => $request->post('parent_id'),
            'description' => $request->post('description'),
        ]);*/

        $category->update( $request->all() );

        return redirect('/admin/categories')->with('success', "Category ($category->name) updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('categories.delete');
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect('/admin/categories')->with('success', "Category ($category->name) deleted");
    }

    protected function validator($request, $id = null)
    {
        $rules = $this->rules($id);
        $validator = Validator::make($request->all(), $rules, [
            'name.required' => ':attribute Required!',
            'parent_id.exists' => 'The parent not exists',
        ]);

        /*if ($validator->fails()) {
            return redirect()->back();
        }*/

        return $validator;
    }

    protected function rules($id = null)
    {
        return [
            //'name' => 'required|max:255|min:3',
            'name' => ['required', 'max:255', 'min:3', "unique:categories,name,$id"],
            'parent_id' => [
                'nullable',
                'exists:categories,id',
                "parent:$id",
                //new ParentRule($id)
                /*function($attribute, $value, $fail) use($id) {
                    $categories = Category::where('id', '<>', $id)
                        ->where(function($query) use($id) {
                            $query->where('parent_id', '<>', $id)
                                ->orWhereNull('parent_id');
                        })
                        ->pluck('id')->toArray();
                    if (!in_array($value, $categories)) {
                        $fail('Invalid parent selected');
                    }
                }*/
            ],
            'description' => 'nullable|max:1000',
        ];
    }

    public function xml()
    {
        $categories = Category::all();
        $xml = '<?xml version="1.0" ?>';
        $xml .= '<categories>';
        foreach($categories as $category) {
            $xml .= sprintf('<category id="%d">', $category->id);
            $xml .= sprintf('<name>%s</name>', $category->name);
            $xml .= '</category>';
        }
        $xml .= '</categories>';

        return response($xml, 200, [
            'Content-Type' => 'application/xml'
        ]);

        // JSON. JavaScript Object Notation
        /*
            [
                {
                    id: 1,
                    name: "Category name"
                    parent: {
                        id: 3,
                        name: "Parent"
                    }
                },
                {
                    id: 1,
                    name: "Category name"
                    parent: {
                        id: 3,
                        name: "Parent"
                    }
                }
            ]


        */
    }

    public function json()
    {
        return Category::all();
    }
}
