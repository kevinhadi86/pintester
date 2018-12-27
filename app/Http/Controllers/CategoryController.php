<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('managecategory',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('addcategory');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),
            [
                'name'=>'required|min:3|max:20'
            ]);
        if ($validate->fails()) {
            return back()->withErrors($validate);
        }
        $category = new Category;
        $category->name = $request->name;
        $category->save();
//        Category::create($request->all());
        return redirect('/manage/category');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category,$id)
    {
        $category = Category::find($id);
        return view('editcategory',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category, $id)
    {
        $validate = Validator::make($request->all(),
            [
                'name'=>'required|min:3|max:20'
            ]);
        if ($validate->fails()) {
            return back()->withErrors($validate);
        }
        $category = Category::find($id);
        $posts = Post::where('category',$category->name)->get();
        foreach($posts as $post){
            $post->category = $request->name;
            $post->save();
        }
        $category->name = $request->name;
        $category->save();
        return redirect('/manage/category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category, $id)
    {
        $category = Category::find($id)->delete();
        return redirect('/manage/category');
    }
}
