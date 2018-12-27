@extends('layout.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add Categories</div>

                    <div class="card-body">
                        <form action="{{url('/add/category')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group row">
                                <label for="name" class="col-sm-4 col-form-label text-md-right">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name"  autofocus>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
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