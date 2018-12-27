<?php

namespace App\Http\Controllers;

use App\Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DetailController extends Controller
{
    public function store($post_id){
        $detail = new Detail;
        $detail->header_id = Session::get('cart');
        $detail->post_id = $post_id;
        $detail->save();
        return redirect('/cart');
    }
    public function destroy($id){
        $detail = Detail::find($id);
        $detail->header->total = $detail->header->total - $detail->post->price;
        $detail->header->save();
        $detail->delete();
        return redirect('/cart');
    }
}
