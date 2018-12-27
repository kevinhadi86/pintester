@extends('layout.layout')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Manage Categories</div>

                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Category ID</th>
                                    <th>Category Name</th>
                                    <th>Auth</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{$category->id}}</td>
                                        <td>{{$category->name}}</td>
                                        <td>
                                            <a href="{{url('/edit/category/'.$category->id)}}">
                                                <button class="btn btn-warning">Edit</button>
                                            </a>
                                            <a href="{{url('/delete/category/'.$category->id)}}">
                                                <button class="btn btn-danger">Delete</button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <a href="{{url('/add/category')}}"><button class="btn btn-primary">Add Category</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection