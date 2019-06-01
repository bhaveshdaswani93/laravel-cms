<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryControllerOld extends Controller
{
    //
    public function __construct()
    {
        // echo "hello";exit;
        $this->middleware('auth');
    }

    public function index()
    {
        return view('categories.index');
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store()
    {
        $this->validate(request(),[
            'name' => 'required'
        ]);
        
        $data = request()->all();
        $category = new Category();
        $category->name = $data['name'];
        $category->save();

        session()->flash('success','Category Saved Successfully');
        return redirect(url('categories'));

    }

    public function edit(Category $category)
    {
        return view('categories.edit')->with('category',$category);
    }

    public function update(Category $category)
    {
        $this->validate(request(),[
            'name' =>'required'
        ]);
        
        $data = request()->all();

        $category->name = $data['name'];
        $category->save();

        session()->flash('success','Category updated Successfully');
        return redirect(url('categories'));
    }

    public function delete(Category $category)
    {
        $category-delete();

        session()->flash('success','Category deleted Successfully');
        return redirect(url('categories'));
    }
    
}
