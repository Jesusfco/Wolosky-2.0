@extends('layouts.visitor')

@section('title')  
    <title>Login</title>
@endsection

@section('css')
    <link href="{{ asset('css/login.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>

    <style>
        .spaceContainer {
            width: 100%;
            height: 100vh;
            display: flex;
            align-content: center;
            align-items: center;
            justify-content: center;
            background-size: cover;
            background-position: center;
        }

        .spaceContainer  .flex {
            display: flex;
        }
        .spaceContainer .flex  > div {
            width: 100%;
            display: block;
        }

        .logoContainer {
            display: flex !important;
            align-content: center;
            align-items: center;
        }
        .logoContainer  img{
            width: 100%;
            
        }

        .card {
            max-width: 600px;
            background: rgba(255, 255, 255,.85);
        }
    </style>
@endsection

@section('scripts')
    
@endsection

@section('content')

<div class="spaceContainer" style="background-image: url({{ url('img/authBackground.jpg') }})">

    <div class="container card">
        
        <div class="titleSection">
            <h1 class="center-text" style="text-align: center">Iniciar Sesión</h1>  
        </div>
        <div class="flex container">
            {{-- <div class="logoContainer"> --}}
                {{-- <img src="{{ url('img/tuchtlan.jpg') }}"> --}}
            {{-- </div> --}}
            <div class="formContainer">
            
                <form class="form-horizontal" method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}
    
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email">Correo</label>
    
                        <div class="col-md-12">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
    
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
    
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password">Contraseña</label>
    
                        <div class="col-md-12">
                            <input id="password" type="password" class="form-control" name="password" required>                       
                        </div>
                        @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                    </div>
                                    
                    <button type="submit" class="btn btn-primary blue l12">
                        Acceder
                    </button>
                    <br>   
                    <a class="forget-link" href="{{ url('recuperar') }}">
                        ¿Olvidaste tu contraseña?
                    </a>
                        
                    
                </form>
                <br><br>
            </div>
        </div>
        
    </div>

</div>
@endsection