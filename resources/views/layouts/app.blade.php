<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="{{url('images/icon.ico')}}"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
<!--<meta name="csrf-token" content="{{ csrf_token() }}">-->

    <title>Wolosky Panel</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="{{url('/css/aplicationDefault.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ url('fonts2/style.css')}}">
    @yield('styles')

<!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-fixed-top" style="margin-bottom: 0">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle " id="menuBoton">
                    <span class="glyphicon glyphicon-th-list" ></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <span class='icon-wolosky' style="font-size:50px; color: white; display: block; margin-top: -12px"></span>
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>

                    @else
                        <li id="notification"><a href=""> <span class="glyphicon glyphicon-inbox"></span></a></li>
                        <li id="logout">
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                                Cerrar Sesión <span class="glyphicon glyphicon-off"></span>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>

                    @endif
                </ul>


            </div>
        </div>
    </nav>

    <br><br>
    @if(Auth::guest())
        <br><br>
        @yield('content')
    @else

            @include('layouts.menuAdmin')

    <br>
        <div class="spacePadding">
            @yield('content')
        </div>

    @endif

</div>

<!-- Scripts -->
<script src="{{ url('/js/app.js') }}"></script>
<script src="{{ url('/js/Aplication/aplicationDefault.js') }}"></script>
@yield('scripts')
</body>
</html>
