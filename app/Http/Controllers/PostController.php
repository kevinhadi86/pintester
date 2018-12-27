<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Header;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query="";
        $posts = Post::paginate(10);
        return view('home',compact('posts','query'));
    }
    public function followed()
    {
        $posts=Post::paginate(10);
        $user = User::find(Session::get('id'));
        return view('followed',compact('posts','user'));
    }
    public function mine()
    {
        $posts = Post::where('user_id',Session::get('id'))->paginate(5);
        return view('mypost',compact('posts'));
    }
    public function search(Request $request){
        $query = $request->name;
        $posts = Post::where('title','like','%'.$query.'%')->paginate(10);
        $posts->appends($request->only('name'));
        return view('home',compact('posts','query'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('addpost', compact('categories'));
    }
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),
            [
                'title'=>'required|min:20|max:200',
                'caption'=>'required',
                'image'=>'required|mimes:jpeg,png,jpg',
                'price'=>'required|numeric',
                'category'=>'required'
            ]);
        if ($validate->fails()) {
            return back()->withErrors($validate);
        }
        $post = new Post;
        $post->user_id=Session::get('id');
        $post->title= $request->title;
        $post->caption = $request->caption;
        $post->price= $request->price;
        $post->category = $request->category;
        $post->image =$request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path().'/img',$post['image']);
        $post->save();
        return redirect('/mypost');
    }
    public function show(Post $post,$id)
    {
        $comments = Comment::where('post_id',$id)->get();
        $post = Post::find($id);
        return view('postdetail',compact('post','comments'));
    }
    public function edit(Post $post)
    {
        //
    }
    public function update(Request $request, Post $post)
    {
        //
    }
    public function destroy(Post $post, $id)
    {
        $header = Header::find(Session::get('cart'));
        $post = Post::find($id);
        foreach ($header->details as $detail){
            if($detail->post == $post){
                $header->total = $header->total - $post->price;
                $header->save();
            }
        }
        $post->delete();

        return redirect('/');
    }
}
