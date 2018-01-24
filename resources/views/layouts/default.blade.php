<!DOCTYPE html>
<html lang="en">
<head>
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
                <li><a href='{{ url('/')}}' class='white-text thin'>        Inicio       </a></li> 
                <li><a href='{{ url('/quienes')}}' class='white-text thin'>      Quienes Somos</a></li>
                <li><a href='{{ url('/noticias')}}' class='white-text thin'>       Noticias     </a></li>
                <li><a href='{{ url('/equipo')}}' class='white-text thin'>       Equipo       </a></li>
                <li><a href='{{ url('/contacto')}}' class='white-text thin'>     Contacto  </a></li>
                <li><a href='{{ url('/suscribete')}}' class='white-text thin'>     Suscribete      </a></li>
                <li><a href='{{ url('/login')}}' class='white-text thin'>     Login      </a></li>
            </ul>
            <ul id='nav-mobile' class='side-nav'>        
                <li><a href='{{ url('/')}}'>        Inicio       </a></li> 
                <li><a href='{{ url('/quienes')}}'>      Quienes Somos</a></li>
                <li><a href='{{ url('/noticias')}}'>       Noticias     </a></li>
                <li><a href='{{ url('/equipo')}}'>       Equipo       </a></li>
                <li><a href='{{ url('/contacto')}}'>     Contacto      </a></li>
                <li><a href='{{ url('/login')}}'>     Login      </a></li>
                
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

<div class="col s12 ">
  <center>
	<!-- <span class="icon-wolosky logofooter" ></span> -->
</center>
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

  </div>  
</div>
</div>

	<div class="col s12 l4">
	</div>

</div>

<div class="footer-copyright black">
      <div class="container">
            Gimnasia Wolosky© <?php echo date("Y");?>
          <a class="grey-text text-lighten-4 right" href="http://kaizensoftware.com.mx">Made by <span style="color:green;">Kaizen</span></a>
      </div>
</div>


    
    <script src="{{ url('js/materialize.min.js')}}"></script>
    <script src="{{ url('js/init.js')}}"></script>
    @section('scripts')
    @show
</body>
</html>