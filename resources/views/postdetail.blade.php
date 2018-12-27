@extends('layout.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1>User</h1>
                        @if(\Illuminate\Support\Facades\Session::get('email')=='admin@gmail.com')
                            <a href="{{url('/add/cart/'.$post->id)}}"><button class="btn btn-primary">Add to Cart</button></a>
                            <a href="{{url('/delete/post/'.$post->id)}}"><button class="btn btn-danger">Delete Post</button></a>
                        @elseif(\Illuminate\Support\Facades\Session::get('id')!=$post->user_id && \Illuminate\Support\Facades\Session::get('id') !="")
                            <a href="{{url('/add/cart/'.$post->id)}}"><button class="btn btn-primary">Add to Cart</button></a>
                        @elseif(\Illuminate\Support\Facades\Session::get('id')==$post->user_id)
                            <a href="{{url('/delete/post/'.$post->id)}}"><button class="btn btn-danger">Delete Post</button></a>
                        @endif
                    </div>
                    @if(\Illuminate\Support\Facades\Session::has('alert'))
                        <div style="color: red;">
                            {{\Illuminate\Support\Facades\Session::get('alert')}}
                        </div>
                    @endif

                    <div class="card-body">
                        <div><h1>{{$post->title}}</h1></div>
                        <div><h5>Author: {{$post->user->name}}</h5></div>
                        <img style="width: 700px;" src="{{asset('img/'.$post->image)}}">
                        <div style="margin-top: 2%;"><h3>{{$post->caption}}</h3></div>
                        @if(\Illuminate\Support\Facades\Session::get('id'))
                            <hr><hr>
                            <div><h1>Comments</h1></div>
                            @foreach($comments as $comment)
                                <div style="overflow: hidden;">
                                    <div style="width: 30%;">
                                        <img style="border-radius: 100%; width: 50px; height: 50px;" src="{{asset('img/'.$comment->user->profilepicture)}}">
                                    </div>
                                    <div style="margin-top: 1%">
                                        <h2>{{$comment->user->name}}</h2>
                                        <h5>{{$comment->comment}}</h5>
                                    </div>
                                </div>
                                <hr>
                            @endforeach
                            <hr>
                            <form method="post" action="{{url('/add/comment/'.$post->id)}}">
                                {{csrf_field()}}
                                <h2>Add your comment</h2>
                                <textarea name="comment" cols="136" rows="8" placeholder="Insert your comment here ...."></textarea>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection