@extends('layout.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11" >
                <div>
                    <a href="{{url('/add/post')}}">
                        <button class="btn btn-primary">Add Post</button>
                    </a>
                </div>
                <div style=" margin: 2% ;display: flex; flex-flow: row wrap;">
                    @foreach($posts as $post)
                        <a href="{{url('/post/'.$post->id)}}" style="text-decoration: none" >
                            <div style="margin: 17px;">
                                <img style="width: 150px; height: 150px" src="{{asset('img/'.$post->image)}}" class="img-rounded img-fluid">
                                <div>
                                    @if(strlen($post->title)>20)
                                        <h4>{{substr($post->title,0,20)}}...</h4><br>
                                    @else
                                        <h4>{{$post->title}}</h4><br>
                                    @endif
                                    @if(strlen($post->caption)>20)
                                        <h6>{{substr($post->caption,0,20)}}...</h6><br>
                                    @else
                                        <h6>{{$post->caption}}</h6><br>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
                {{$posts->links()}}
            </div>
        </div>
    </div>

@endsection