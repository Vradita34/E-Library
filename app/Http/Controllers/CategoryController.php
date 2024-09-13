<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categories::latest()->paginate(15);
        return view('admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.add_category');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:categories',
        ]);
        Categories::create($data);
        return redirect()->route('categories.index')->with('success','add category success');
    }

    /**
     * Display the specified resource.
     */
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        
        $category = Categories::find($id);
        
        return view('admin.categories.edit_category',compact('category'));
    }   

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string',
        ]);
        $category = Categories::find($id);
        $category->name = $data['name'];
        $category->save();
        return redirect()->route('categories.index')->with('success','update category success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $categories = Categories::find($id);
        $categories->delete();
        return redirect()->route('categories.index')->with('success','delete category successfullly');
    }
}
