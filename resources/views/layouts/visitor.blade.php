<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-117856789-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-117856789-1');
    </script>

    <link rel="shortcut icon" href="{{url('images/icon.ico')}}"/>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  @section('title')
  @show

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="{{ url('css/materialize.min.css')}}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="{{ url('css/style.css')}}" type="text/css" rel="stylesheet" media="screen,projection"/>  
  <link rel="stylesheet" type="text/css" href="{{ url('fonts2/style.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ url('css/head.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ url('css/footer.css')}}">
  @section('css')
  @show
  
  <!--Fonts -->
      
      
      <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500italic,500,700,900,700italic,900italic' rel='stylesheet' type='text/css'>      
      <link href='https://fonts.googleapis.com/css?family=Dancing+Script:400,700' rel='stylesheet' type='text/css'>

      <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      

</head>
<body>
    <div class='navbar-fixed'>
    <nav class='cyan darken-4 z-depth-1 subrayado' role='navigation'>    
        <div class='nav-wrapper container'>      
            <a id='logo-container' href='{{ url('/')}}' ><span class='icon-wolosky'></span></a>
            <ul class='right hide-on-med-and-down' >        
                <li class="@if(Request::is('/'))active @endif">
                    <a href='{{ url('/')}}' class='white-text thin'>        Inicio       </a></li> 
                <li class="@if(Request::is('/quienes'))active @endif">
                    <a href='{{ url('/quienes')}}' class='white-text thin'>      Quienes Somos</a></li>
                <li class="@if(Request::is('/noticias*'))active @endif">
                    <a href='{{ url('/noticias')}}' class='white-text thin'>       Noticias     </a></li>
                <li class="@if(Request::is('/equipo'))active @endif">
                    <a href='{{ url('/equipo')}}' class='white-text thin'>       Equipo       </a></li>
                <li class="@if(Request::is('/contacto'))active @endif">
                    <a href='{{ url('/contacto')}}' class='white-text thin'>     Contacto  </a></li>
                
                
            </ul>
            <ul id='nav-mobile' class='side-nav'>        
                <img class="logoNavMobile" src="{{ url('images/Wolosky-Logo.png')}}">
                <li class="@if(Request::is('/'))active @endif">
                    <a href='{{ url('/')}}'>        Inicio       </a></li> 
                <li class="@if(Request::is('/quienes'))active @endif">
                    <a href='{{ url('/quienes')}}'>      Quienes Somos</a></li>
                <li class="@if(Request::is('/noticias*'))active @endif">
                    <a href='{{ url('/noticias')}}'>       Noticias     </a></li>
                <li class="@if(Request::is('/equipo'))active @endif">
                    <a href='{{ url('/equipo')}}'>       Equipo       </a></li>
                <li class="@if(Request::is('/contacto'))active @endif">
                    <a href='{{ url('/contacto')}}'>     Contacto      </a></li>
                
                <img class="splashBack" src="{{ url('images/nav-splash.jpg')}}">

                {{-- <li><img class="logoNavMobile" src="{{ url('images/Wolosky-Logo.png')}}"></li>

                <li><a href='{{ url('/')}}'> <i class="material-icons">home</i>        Inicio       </a></li> <br>
                <li><a href='{{ url('/quienes')}}'> <i class="material-icons">lightbulb_outline</i>      Quienes Somos</a></li>
                <li><a href='{{ url('/noticias')}}'> <i class="material-icons">event_note</i>      Noticias     </a></li>
                <li><a href='{{ url('/equipo')}}'> <i class="material-icons">group</i>       Equipo       </a></li>
                <li><a href='{{ url('/contacto')}}'> <i class="material-icons">mail</i>     Contacto      </a></li>
                
                <li><img class="splashBack" src="{{ url('images/nav-splash.jpg')}}"></li> --}}

            </ul>      
            <a href='#' data-activates='nav-mobile' class='right button-collapse'><i class='material-icons white-text'>menu</i></a>    
        </div>
    </nav>
    </div>
    
    @section('content')
    @show
     
<footer class="page-footer">

    <div class="row">
        
        <!-- Redes Sociales -->
        <div class="col s12 l6">
        
            <div class="redes">

                <h2 class="light flow-text">Siguenos en:</h2>

                <div class="redesimagenes">
                    <a href="https://www.facebook.com/Gimnasia-Artistica-WOLOSKY-101212723267687/?fref=ts" class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Facebook!">
                        <img src="{{ url('images/footer/facebook.png')}}" class="hvr-grow-shadow">
                    </a>

                    <a href="https://twitter.com/rebewolosky" class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Twitter!">
                        <img src="{{ url('images/footer/twitter.png')}}">
                    </a>  
                    <a href="https://www.instagram.com/woloskygimnasia/" class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Instagram!">
                        <img src="{{ url('images/footer/instagram.png')}}">
                    </a>
                    <a href="https://www.youtube.com/user/WoloskyGym" class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Youtube!">
                        <img src="{{url('images/footer/youtube.png')}}">
                    </a>
                    <a href="https://api.whatsapp.com/send?phone=5219615936833" class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Enviame un mensaje!">
                        <img src="{{url('images/footer/whats.png')}}">
                    </a>

                </div>  
            </div>
        </div>

        <div class="col s12 l3">
            <h5>Contacto</h5>
            <p class="thin">Avenida 2 poniente #338, Colonia C.P. 29000. Tuxtla Gutiérrez, Chiapas</p>
        </div>

        <div class="col s12 l3">
            <h5>Links</h5>
            <ul class='' >        
                <li><a href='{{ url('/') }}' class='white-text thin'>        Inicio       </a></li> 
                <li><a href='{{ url('/quienes') }}' class='white-text thin'>      Quienes Somos</a></li>
                <li><a href='{{ url('/noticias') }}' class='white-text thin'>       Noticias     </a></li>
                <li><a href='{{ url('/equipo') }}' class='white-text thin'>       Equipo       </a></li>
                <li><a href='{{ url('/contacto') }}' class='white-text thin'>     Contacto  </a></li>                                
                <li><a href='{{ url('/login') }}' class='white-text thin'>     Login  </a></li>                                
            </ul>
        </div>

    </div>

    <div class="footer-copyright black">
        <div class="container">
                Gimnasia Wolosky© <?php echo date("Y");?>
            <a class="grey-text text-lighten-4 right" href="http://roguezservices.com/">Made by <img src="http://roguezservices.com/img/logoNav.png"></a>
        </div>
    </div>

</footer>

@if(!Request::is('/noticias*')) 
    <a href="https://api.whatsapp.com/send?phone=5219615936833" class="tooltipped whatsFloating" data-position="left" data-delay="50" data-tooltip="!Contáctame!">
        <img src="{{ url('images/whatsapp.png')}}">
    </a>
@endif
<style>
    .whatsFloating {
        position: fixed;
        right: 25px;
        bottom: 25px;
    }

    .whatsFloating img {
        width: 120px;
        display: block
    }
    .footer-copyright .right {
        display:flex;
    }
    .footer-copyright .right img {
        height: 40px;
        position: relative;
        top: 5px;
        margin-left: 20px;
    }

    @media (max-width: 900px) {
        footer * {
            text-align: center
        }
        .whatsFloating{ 
            right: 15px;
            bottom: 15px;
        }
        .whatsFloating img { width: 80px }

    }
</style>

    
    <script src="{{ url('js/materialize.min.js')}}"></script>
    <script src="{{ url('js/init.js')}}"></script>
    @section('scripts')
    @show
</body>
</html>