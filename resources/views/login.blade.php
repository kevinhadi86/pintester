@extends('layout.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('/login') }}">
                            {{csrf_field()}}

                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">E-Mail</label>

                                <div class="col-md-6">
                                    @if(\Illuminate\Support\Facades\Cookie::get('email'))
                                        <input id="email" type="text" class="form-control" name="email" value="{{\Illuminate\Support\Facades\Cookie::get('email')}}" autofocus>
                                    @else
                                        <input id="email" type="text" class="form-control" name="email"  autofocus>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                <div class="col-md-6">
                                    @if(\Illuminate\Support\Facades\Cookie::get('password'))
                                        <input id="password" type="password" class="form-control" name="password" value="{{\Illuminate\Support\Facades\Cookie::get('password')}}">
                                    @else
                                        <input id="password" type="password" class="form-control" name="password" >
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row checkbox">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" value="checked" id="remember">
                                        <label class="form-check-label" for="remember">
                                            Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>
                                </div>
                            </div>
                            <div style="color: red;">
                                @if(isset($errors))
                                    {{$errors->first()}}
                                @endif
                                @if(\Illuminate\Support\Facades\Session::has('alert'))
                                    {{\Illuminate\Support\Facades\Session::get('alert')}}
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection