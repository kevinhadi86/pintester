@extends('layout.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" >
                <div style="text-align: center !important">
                    <div>
                        <img style="width: 100px; height: 100px; border-radius: 100%" src="{{asset('img/'.$user->profilepicture)}}">
                        <div>
                            <h1>{{$user->name}}</h1>
                            <h3>{{$user->email}}</h3>
                        </div>
                    </div>
                    <div>
                        <a href="{{url('/edit/profile')}}">
                            <button class="btn btn-outline-primary">Profile</button>
                        </a>
                        <a href="{{url('/edit/profile/category')}}">
                            <button class="btn btn-primary">Category</button>
                        </a>
                    </div>
                </div>
                <div class="card">
                    <h1 class="card-header">Edit Profile</h1>

                    <div class="card-body">
                        <form method="POST" action="{{ url('/edit/profile/category/'.$user->id) }}" >
                            {{csrf_field()}}
                            <div class="form-group checkbox">
                                @foreach($categories as $category)
                                    <label for="name" class="col-md-2 col-form-label text-md-left">
                                        <input type="checkbox" name="category[]" value="{{$category->name}}">{{$category->name}}
                                    </label>
                                @endforeach
                            </div>

                            <div style="text-align: center;">
                                <div>
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection