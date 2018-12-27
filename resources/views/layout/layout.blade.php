<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

</head>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container-fluid">
            <div style="width: 30%">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" style="width: 20%" href="{{url('/')}}">
                    <img alt="Brand"  class="img-responsive" src="{{asset('img/logo.png')}}">
                </a>
                <?php $user = \Illuminate\Support\Facades\Session::get('name')?>
                <div id="clock" class="{{$user}}"></div>
                <form class="navbar-form navbar-left mr-auto" action="{{url('/search')}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                @if(\Illuminate\Support\Facades\Session::get('email'))
                    @if(\Illuminate\Support\Facades\Session::get('email') == 'admin@gmail.com')
                        <ul class="nav navbar-nav navbar-right ml-auto">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Manage</a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{url('/manage/user')}}">User</a></li>
                                    <li><a href="{{url('/manage/category')}}">Category</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">View</a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{url('/history/all')}}">All Transaction</a></li>
                                </ul>
                            </li>
                            <li><a href="{{url('/cart')}}">Cart</a></li>
                            <li><a href="{{url('/mypost')}}">My Post</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <img style="width: 20px;height: 20px; border-radius: 100%" src="{{asset('img/'.\Illuminate\Support\Facades\Session::get('picture'))}}">
                                    {{\Illuminate\Support\Facades\Session::get('name')}}
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{url('/edit/profile')}}">Profile</a></li>
                                    <li><a href="{{url('/history')}}">Transaction History</a></li>
                                    <li><a href="{{url('/logout')}}">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    @else
                        <ul class="nav navbar-nav navbar-right ml-auto">
                            <li><a href="{{url('/cart')}}">Cart</a></li>
                            <li><a href="{{url('/mypost')}}">My Post</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <img style="width: 20px;height: 20px;border-radius: 100%" src="{{asset('img/'.\Illuminate\Support\Facades\Session::get('picture'))}}">
                                    {{\Illuminate\Support\Facades\Session::get('name')}}
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{url('/edit/profile')}}">Profile</a></li>
                                    <li><a href="{{url('/history')}}">Transaction History</a></li>
                                    <li><a href="{{url('/logout')}}">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    @endif
                @else
                    <ul class="nav navbar-nav navbar-right ml-auto">
                        <li><a href="{{url('/login')}}">Login</a></li>
                        <li><a href="{{url('/register')}}">Register</a></li>
                    </ul>
                @endif
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>

<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
<script>
    $(document).ready(function(){
        function normalize(digit) {
            if (digit < 10) {
                digit = "0" + digit;
            }
            return digit;
        }
        function current() {
            let time = new Date();
            let now = normalize(time.getHours())+":"+normalize(time.getMinutes())+":"+normalize(time.getSeconds());
            let content = $('#clock').attr('class');
            $('#clock').html('Hello, '+content+' | '+now);
        }
        setInterval(current(), 1000);
    });
</script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
</body>
</html>