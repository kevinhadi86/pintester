@extends('layout.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11" >
                @if(count($headers)==0)
                    <div>
                        <h2>You don't have anything here</h2>
                    </div>
                @else
                    @foreach($headers as $header)
                        <div>
                            <h2>Transaction ID: {{$header->id}}</h2>
                            <h2>Buyer: {{$header->user->name}}</h2>
                            <h2>Total Price: Rp {{$header->total}}</h2>
                            <h2>Transaction Date: {{$header->date}}</h2>
                        </div>
                        <div style="margin: 2%;">
                            <table class=" table table-hover">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                        @foreach($header->details as $detail)
                                            <tr>
                                                <td>
                                                    <img src="{{asset('/img/'.$detail->post->image)}}" class="img-fluid" style="width: 150px; height: 150px">
                                                </td>
                                                <td>
                                                    <h4>{{$detail->post->title}}</h4>
                                                </td>
                                                <td>
                                                    <h4>{{$detail->post->price}}</h4>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                            </table>
                        </div>
                        <hr>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

@endsection