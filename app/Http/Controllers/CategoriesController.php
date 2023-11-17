<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function index()
    {
        $categories = Category::all();

        return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * 
     */
    public function store(Request $request)
    {

        
        $this->validate($request, [
            'name' => 'required|unique:categories|max:255',
            'color' => 'required|max:7',
        ]);

        $category = new Category;
        $category->name = $request->name;
        $category->color = $request->color;
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category has been added');
    }

    /**
     * Display the specified resource.
     *
     */
    public function show($id)
    {
        $category = Category::find($id);
        return view('categories.show', ['category' => $category]);       
    }

    /**
     * Show the form for editing the specified resource.
     *

     */
    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $category)
    {
        $category = Category::find($category);
        
        $category->name = $request->name;
        $category->color = $request->color;
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }

    
    public function destroy($category)
    {
        //
        $category = Category::find($category);
        $category->todos()->each(function($todo) {
            $todo->delete(); 
         });
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }
}