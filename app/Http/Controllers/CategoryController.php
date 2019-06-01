<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\categories\CreateCategoryRequest;
use App\Http\Requests\categories\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public function __construct()
    {
        // exit;
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd('hello');

        return view('categories.index')->with('categories',Category::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        // $this->validate($request,[
        //     'name' => 'required|unique:categories'
        // ]);
        Category::create($request->all());
        // $data = request()->all();
        // $category = new Category();
        // $category->name = $data['name'];
        // $category->save();

        session()->flash('success','Category Saved Successfully');
        return redirect(route('categories.index'));        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('categories.show')->with('category',$category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit')->with('category',$category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        // $this->validate($request,[
        //     'name' =>['required',
        //         Rule::unique('categories')->ignore($category->id)
        //     ]
        // ]);
        
        // $data = request()->all();

        // $category->name = $data['name'];
        // $category->save();
        
        $category->update($request->all());
        session()->flash('success','Category updated Successfully');
        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        // dd($category);
        try{
            $category->delete();
            $message='Category deleted Successfully';
            $flag='success';
        }
        catch(\Illuminate\Database\QueryException $e)
        {
                $message ="Category cannot be deleted as it has some post attach to it";
                $flag='error';

        }

        session()->flash($flag,$message);
        return redirect(route('categories.index'));

        
    }
}
