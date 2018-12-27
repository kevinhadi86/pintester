@extends('layout.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11" >
                @if(!(\Illuminate\Support\Facades\Session::get('cart')) || count($details)==0)
                    <div>
                        <h2>You don't have anything here</h2>
                    </div>
                @else
                    <div>
                        <h2>Item in cart: {{count($details)}}</h2>
                    </div>
                    @foreach($details as $detail)
                        <div style="margin: 2%;width: 700px;height: 200px;">
                            <div style="float: left;">
                                <img src="{{asset('/img/'.$detail->post->image)}}" class="img-fluid" style="width: 150px; height: 150px">
                            </div>
                            <div style=" margin: 2% ;float: left">
                                <h2>Image Title: {{$detail->post->title}}</h2>
                                <h2>Image Price: Rp {{$detail->post->price}}</h2>
                                <h2>Image Owner: {{$detail->post->user->name}}</h2>
                                <div><a href="{{url('/delete/detail/'.$detail->id)}}"><button class="btn btn-danger">Delete</button> </a></div>
                            </div>

                        </div>
                    @endforeach
                    <h1>Total price: {{$header->total}}</h1>
                    <div>
                        <a href="{{url('/checkout')}}">
                            <button class="btn btn-primary">Checkout</button>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection