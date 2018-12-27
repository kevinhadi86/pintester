<?php

namespace App\Http\Controllers;

use App\Category;
use App\Header;
use App\User;
use App\UserCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('manageuser',compact('users'));
    }
    public function showLogin(){
        return view('login');
    }
    public function showRegister(){
        return view('register');
    }
    public function login(Request $request){
        $validate = Validator::make($request->all(),
        [
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if ($validate->fails()) {
            return back()->withErrors($validate);
        }

        $data = User::where('email',$request->email)->first();
        if(!empty($data)){
            if ($request->password == $data->password) {
                Session::put('id',$data->id);
                Session::put('name',$data->name);
                Session::put('email',$data->email);
                Session::put('picture',$data->profilepicture);
                if($request->remember == 'checked'){
                    if(!Cookie::get('email')){
                        Cookie::queue(Cookie::forget('email'));
                        Cookie::queue(Cookie::forget('password'));
                    }
                    Cookie::queue(Cookie::make('email',$data->email,1));
                    Cookie::queue(Cookie::make('password',$data->password),1);
                }
                return redirect('/');
            }else{
                return redirect('/login')->with('alert','Email or Password is Wrong');
            }
        }else{
            return redirect('/login')->with('alert','Email or Password is Wrong');
        }
    }
    public function register(Request $request){
        $validate = Validator::make($request->all(),
            [
                'name'=>'required|min:5',
                'email'=>'required|email|unique:users',
                'gender'=>'required',
                'profilepicture'=>'required|mimes:jpeg,png,jpg',
                'password'=>'required|alpha_num|min:8',
                'confirm'=>'required|same:password'
            ]);
        if ($validate->fails()) {
            return back()->withErrors($validate);
        }
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->password = $request->password;
        $user->profilepicture =$request->file('profilepicture')->getClientOriginalName();
        $request->file('profilepicture')->move(public_path().'/img',$user['profilepicture']);
        $user->save();
        return redirect('/login');
    }
    public function logout(){
        if(Session::get('cart')){
            $header = Header::find(Session::get('cart'));
            $header->delete();
        }
        Session::flush();
        return redirect('/login');
    }
    public function edit(){
        $user = User::find(Session::get('id'));
        return view('editprofile',compact('user'));
    }
    public function editUser($id){
        $user = User::find($id);
        return view('edituser',compact('user'));
    }
    public function editCategory(){
        $user = User::find(Session::get('id'));
        $categories = Category::all();
        return view('editusercategory',compact('user','categories'));
    }
    public function update(Request $request,$id){
        $user = User::find($id);
        if($request->email == $user->email){
            $validate = Validator::make($request->all(),
                [
                    'name'=>'required|min:5',
                    'password'=>'required|alpha_num|min:8',
                    'gender'=>'required'
                ]);
            if ($validate->fails()) {
                return back()->withErrors($validate);
            }
        }else{
            $validate = Validator::make($request->all(),
                [
                    'name'=>'required|min:5',
                    'email'=>'required|email|unique:users',
                    'password'=>'required|alpha_num|min:8',
                    'gender'=>'required'
                ]);
            if ($validate->fails()) {
                return back()->withErrors($validate);
            }
        }

        if($request->old ==$user->password){
            $user->name = $request->name;
            Session::flush();
            Session::put('id',$user->id);
            Session::put('name',$user->name);
            Session::put('email',$user->email);
            Session::put('picture',$user->profilepicture);
            if($request->email != $user->email){
                $user->email = $request->email;
                Session::forget('email');
                Session::put('email', $user->email);
            }
            $user->gender = $request->gender;
            $user->password = $request->password;
            $user->save();
            return redirect('/');
        }else{
            return redirect('/edit/profile')->with('alert','Old password is wrong');
        }
    }
    public function updateUser(Request $request,$id){
        $user = User::find($id);
        if($request->email == $user->email){
            $validate = Validator::make($request->all(),
                [
                    'name'=>'required|min:5',
                    'gender'=>'required'
                ]);
            if ($validate->fails()) {
                return back()->withErrors($validate);
            }
        }else{
            $validate = Validator::make($request->all(),
                [
                    'name'=>'required|min:5',
                    'email'=>'required|email|unique:users',
                    'gender'=>'required'
                ]);
            if ($validate->fails()) {
                return back()->withErrors($validate);
            }
        }

        $user->name = $request->name;
        if($request->email != $user->email){
            $user->email = $request->email;
        }
        $user->gender = $request->gender;
        $user->save();
        return redirect('/manage/user');
    }
    public function updateCategory(Request $request, $id){
        $user = User::find($id);
//        $catgories = UserCategory::where('user_id',$id)->get();
        $categories = $user->categories;
//        foreach($test as $t){
//            dd($t->id);
//        }
//        dd(count($categories));
        $input = $request->input('category');
        if(count($categories) ==0){
//            dd('asd');
            for ($i = 0; $i<count($input);$i++){
                $user_category = new UserCategory;
                $user_category->user_id = $id;
                $user_category->category = $input[$i];
                $user_category->save();
            }
        }else{
//            dd('dsa');
            foreach ($categories as $category){
                $flag = 1;
                for ($i = 0; $i<count($input);$i++){
//                        dd($input[$i]);
//                        dd($category->category);
                    if($category->category == $input[$i]){
//                        dd('true');
                        $flag = 0;
                        break;
                    }
                }
//                dd($flag);
                if($flag==1){
//                    dd('delete'.$category);
                    $category->delete();
                }
            }
            for ($i = 0; $i<count($input);$i++){
                $flag = 1;
                foreach ($categories as $category){
                    if($category->category == $input[$i]){
                        $flag = 0;
                        break;
                    }
                }
                if($flag==1){
                    $user_category = new UserCategory;
                    $user_category->user_id = $id;
                    $user_category->category = $input[$i];
                    $user_category->save();
                }
            }
        }
//        dd('clear');
        return redirect('/');
    }
    public function destroy($id){
        $user = User::find($id)->delete();
        return redirect('/manage/user');
    }
}
