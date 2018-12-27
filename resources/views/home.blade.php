@extends('layout.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11" >
                @if($query)
                    <h2>Search result for: '{{$query}}'</h2>
                @elseif(\Illuminate\Support\Facades\Session::get('id'))
                    <div>
                        <a href="{{url('/followed')}}">
                            <button class="btn btn-outline-primary">View Followed</button>
                        </a>
                    </div>
                @endif
                <div style="margin: 2%;display: flex; flex-flow: row wrap;">
                    @foreach($posts as $post)
                        <a href="{{url('/post/'.$post->id)}}" style="text-decoration: none" >
                            <div style="margin: 22px;">
                                <img style="width: 140px; height: 140px" src="{{asset('img/'.$post->image)}}" class="img-rounded img-fluid">
                                <div>
                                    @if(strlen($post->title)>20)
                                        <h5>{{substr($post->title,0,20)}}...</h5><br>
                                    @else
                                        <h5>{{$post->title}}</h5><br>
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