<?php

namespace App\Http\Controllers;

use App\Header;
use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HeaderController extends Controller
{
    public function store($post_id){
        $post = Post::find($post_id);
        if(Session::get('cart')){
            $header = Header::find(Session::get('cart'));
//            dd($header->details);
            foreach($header->details as $detail){
                if($detail->post_id == $post->id){
                    return redirect('/post/'.$post_id)->with('alert','You have already put this post into your cart');
                }
            }
            $header->total = $header->total + $post->price;
            $header->save();
            return redirect('add/detail/'.$post_id);
        }else {
            $header = new Header;
            $header->user_id = Session::get('id');
            $header->total = $post->price;
            $header->date = Carbon::now();
            $header->save();
            Session::put('cart', $header->id);
            return redirect('add/detail/' . $post_id);
        }
        dd('Error di header store');
    }

    public function show(){
        if(!Session::get('cart')){
            return view('cart');
        }
        $header = Header::find(Session::get('cart'));
        $details = $header->details;
//        dd('success');
        return view('cart',compact('header','details'));
    }
    public function checkout(){
        $header = Header::find(Session::get('cart'));
        $header->date = Carbon::now();
        $header->save();
        Session::forget('cart');
        return redirect('/');
    }
    public function history(){
        $headers = Header::where('user_id', Session::get('id'))->get();
        return view('history', compact('headers'));
    }
    public function index(){
        $headers = Header::all();
        return view('history', compact('headers'));
    }
}
