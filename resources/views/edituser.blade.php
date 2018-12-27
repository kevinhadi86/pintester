@extends('layout.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" >
                <div style="text-align: center !important">
                    <img style="width: 100px; height: 100px; border-radius: 100%" src="{{asset('img/'.$user->profilepicture)}}">
                </div>
                <div class="card">
                    <h1 class="card-header">Edit Profile</h1>

                    <div class="card-body">
                        <form method="POST" action="{{ url('/edit/user/'.$user->id) }}" >
                            {{csrf_field()}}

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">ID</label>

                                <div class="col-md-6">
                                    <input id="id" type="text" class="form-control" name="id" value="{{$user->id}}" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" placeholder="{{$user->name}}" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-mail</label>

                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control" name="email" placeholder="{{$user->email}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="gender" class="col-md-4 col-form-label text-md-right">Gender</label>

                                <div class="col-md-6">
                                    <select name="gender">
                                        <option>Select Gender</option>
                                        <option value="Male" name="gender">Male</option>
                                        <option value="Female" name="gender">Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <a href="{{url('/manage/user')}}">
                                        <div class="btn btn-info">
                                            Discard Changes
                                        </div>
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        Save Changes
                                    </button>
                                    <a href="{{url('/delete/user/'.$user->id)}}">
                                        <div class="btn btn-danger">
                                            Delete User
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div style="color: red;">
                                @if(isset($errors))
                                    {{$errors->first()}}
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection