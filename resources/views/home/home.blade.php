@extends('layouts.default')

    @section('css')  
        <link rel="stylesheet" type="text/css" href="css/index.css">
    @endsection

    @section('title')  
    <title>Wolosky - Gimnasia Artística - Tuxtla Gutierrez, Chiapas</title>
    @endsection
    
@section('content')        
    
    <div id="padreParallax" class="parallax-container">    
      <div class="container" id="hijoParallax">                
            <h1 class="portada1" align="center" style="margin-top: 0px;" >Academia de Gimnasia Wolosky</h1>        
            <h3 id="fade" class="thin slogan" align="center">Una academia de gimnasia con mas de 19 años de experiencia</h3>   
            <center>
                <a href="quienes" id=""  class="btn-large waves-effect waves-light blue darken-4">Conocenos mas...</a>
            </center>             
        </div>
    
        <div class="parallax"><img src="images/index/portada.jpg" alt="Unsplashed background img 1"  style="margin-top:0px;"></div>
    </div>
<br>

    <div class="blogContent">

    
        @foreach($noticias as $n)
            <div class='blog'>

                    <a href='noticias/{{ $n->id }}'> 
                        <img class='responsive-img' id="agrandamiento" src='images/noticias/{{ $n->id }}/{{ $n->imagen }}'></a> 
                    <a href='noticias/{{ $n->id }}'>
                    <h5 class='center tituloNoticia black-text'>"{{ $n->titulo }}"</h5>
                    </a>
                    <blockquote class='roboto'><p style='line-height: 1rem'>"{{ $n->resumen }}"</p>

                    <a href='noticias/{{ $n->id }}'   class='btn waves-effect waves-light red darken-4'>Leer más..</a>
                    </blockquote>

            </div>
        @endforeach
    </div>
          
    
    <div class="container row queEs blue darken-4 z-depth-4">
        <div class="col s12 m8" style="padding: 0px;">
            <img src="images/index/gimnasia.jpg">
        </div>
        <div class="col s12 m4 white-text queEsHijo" style="padding: 0px;">
            <div style="padding: 15px">
                <h4 style="font-family: 'Oswald', sans-serif">¿Qué es la Gimnasia?</h4>
                <p>Consiste en la realización de una composición coreográfica, combinando de forma simultánea y a una alta velocidad los movimientos corporales.</p>
                 <a href="gimnasia" id=""  class="btn-large waves-effect waves-light red darken-4">Leer más..</a>
            </div>
        </div>
  </div>
    <br>
  
<!--  			<a href="noticias/galerias/50/index.php" style="color: black;text-decoration: none;">
  			<h3 align="center" style="font-family:'Dancing Script', cursive" class="gal">Galeria Festival Nacional de Gimnasia</h3> </a>  			
  	  -->
<!--  <div class="carousel">
    <a class="carousel-item" href="#one!"><img src="noticias/images/50/carusel1.jpg"></a>
    <a class="carousel-item" href="#two!"><img src="noticias/images/50/carusel2.jpg"></a>
    <a class="carousel-item" href="#three!"><img src="noticias/images/50/carusel3.jpg"></a>
    <a class="carousel-item" href="#four!"><img src="noticias/images/50/carusel4.jpg"></a>
    <a class="carousel-item" href="#five!"><img src="noticias/images/50/carusel5.jpg"></a>
    <a class="carousel-item" href="#five!"><img src="noticias/images/50/carusel1.jpg"></a>
  </div>-->
  
  <!-- Video section------------------------------------------------------------>

    <div class="row videoSection">
        
        <h1 class="center light slogan2" style="font-family: 'Oswald', sans-serif">Wolosky Gym en Festival Nacional GPT</h1>
        <div class="col s12 l6 offset-l3" style="padding:0;">
        <div class="video-container"> 
        <iframe width="560" height="315" src="https://www.youtube.com/embed/zr9sGcgwAFs" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
        </div>
         
      </div>
        <div class="col s12 m8 offset-m2">
            <h5  class="light descripcionC"style="text-align: center;">Magna y triunfal resultó ser la actuación de 
            la Academia de Gimnasia Artística Wolosky Gym, dentro del marco del Festival Nacional de Gimnasia Para Todos 2017, 
            celebrado del 30 de noviembre al 3 de diciembre en el Polideportivo de la 
            Universidad Anáhuac de la ciudad de Querétaro, donde cerca de 50 chiapanecos tomaron parte de este magno evento. </h5>
            <center>
                <a href="noticias/99"  class="btn waves-effect waves-light blue darken-4">Leer mas...</a>
            </center> 
            <br><br>
        </div>
       
    </div>
  
  
  
  
  <div id="paral" class="parallax-container valign-wrapper">    
      <div class="container valign">                        
        <h5 class="thin slogan " align="center">
            La Gimnasia Artística consiste en la realización de una composición coreográfica, 
            combinando de forma simultánea y a una alta velocidad los movimientos corporales. La 
            gimnasia artística consiste en la realización de una composición coreográfica, combinando de 
            forma simultánea y a una alta velocidad los movimientos corporales.</h5>                       
      </div>    
      <div class="parallax"><img src="images/index/sliFondo.jpg" alt="Unsplashed background img 1"  style="margin-top:0px;"></div>
  </div>
  
  

<div class="row">
    <br><br>
    <h2 class="center light">UBICACIÓN</h2>
    <br>
    <div class="maps">
      <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7640.8387130153105!2d-93.1219049!3d16.7557992!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0000000000000000%3A0x8e812b55b7fa66f5!2sWolosky+Gimnasia+Artistica!5e0!3m2!1ses!2smx!4v1465791139473" width="1200" height="100%" frameborder="0" style="border:0"   allowfullscreen class="mapa" scaleControl= "false" navigationControl="false"></iframe>
    </div>
    <br>
    <div class="direccion">
        <p class="center">Avenida 2 poniente 338, Colonia Centro</p>
        <p class="center">Santo Domingo C.P. 29000</p>
        <p class="center">Tuxtla Gutiérrex, Chiapas</p>
    </div>

    <br><br>
    <img src="images/index/logo1.jpg" id="logo1">
     
</div>  
  
  <div class="container row queEs blue darken-4 z-depth-4">
        <div class="col s12 l8" style="padding: 0px;">
            <img src="images/index/ubicacion1.jpg">
        </div>
        <div class="col s12 m4 white-text queEsHijo" style="padding: 0px;">
            <div style="padding: 15px">
                <center>
                    <h3 style="font-family: 'Oswald', sans-serif">Horarios</h3>
                    <h5>Lunes a Viernes</h5>
                    <p>16:00 hrs - 20:00 hrs</p>
                    <h5>Sábado</h5>
                    <p>9:00 hrs - 13:00 hrs</p>
                    <a href="contacto" id=""  class="btn-large waves-effect waves-light red darken-4">Contactanos..</a>
                </center>
            </div>
        </div>
  </div>
  <br><br>

@endsection

    @section('scripts')    
        <script src="js/index.js"></script>    
    @endsection