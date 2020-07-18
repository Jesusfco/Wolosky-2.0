@extends('layouts.visitor')
 @section('title')
    <title>Equipo Wolosky - Gimnasia Artística - Tuxtla Gutierrez, Chiapas</title>
@endsection
@section('content') 
    <div class="slider fullscreen">
    <ul class="slides">
      @foreach($team as $obj)
      <li>
        <img src="{{ $obj->img_path }}"> <!-- random image -->
        <div class="caption left-align texto" style="opacity: .8;">
          <h3 class="oswaldo">{{ $obj->name }}</h3>
          <h5 class="light grey-text text-lighten-3 thin">{{ $obj->sentence }}</h5>
        </div>
      </li>

      @endforeach

   

{{-- <li>
        <img src="images/equipo/moi.jpg"> 
        <div class="caption left-align">
          <h3 class="oswaldo">Led. Moisés Marín</h3>
          <h5 class="light grey-text text-lighten-3 thin">"Entrenador representante de Academia de Gimnasia Wolosky"</h5>
        </div>
      </li> --}}

      <li>
        <img src="images/equipo/diana.jpg"> 
        <div class="caption left-align">
          <h3 class="oswaldo">Led. Diana Lizeth Archila Castañón</h3>
          <h5 class="light grey-text text-lighten-3 thin">“Me gusta porque es un deporte que implica mucha disciplina, mucha constancia, así como mucha dedicación para poder vencer tus miedos.”</h5>
        </div>
      </li>

{{--<li>--}}
    {{--<img src="images/equipo/sr.jpg"> <!-- random image -->--}}
    {{--<div class="caption left-align">--}}
      {{--<h3 class="oswaldo">Lic. Jose Raul Morales Morales</h3>--}}
      {{--<h5 class="light grey-text text-lighten-3 thin">"Soy entrenador de Gimnasia, lo que gusta de la gimnasia es la disciplina con la que se tiene que aplicar, tiene que ser exacta y lo bonito es que un ejercicio bien hecho es estético, elegante..."</h5>--}}
    {{--</div>--}}
  {{--</li>--}}


{{-- <li>
        <img src="images/equipo/humberto.jpg"> <!-- random image -->
        <div class="caption left-align">
            <h3 class="oswaldo">Lefd. Jose Humberto Reyes</h3>
            <h5 class="light grey-text text-lighten-3 thin">"La gimnasia implica retos diarios, requiere mucha fuerza y mucho control..."</h5>
        </div>
    </li> --}}

    {{-- <li>
      <img src="images/equipo/elmer.jpg"> <!-- random image -->
      <div class="caption left-align">
          <h3 class="oswaldo">Lefd. Elmer de Jesús</h3>
          <h5 class="light grey-text text-lighten-3 thin">“Me gusta porque es un deporte que implica mucha disciplina, mucha constancia, así como mucha dedicación para poder vencer tus miedos.”</h5>
      </div>
  </li> --}}

  {{-- <li>
    <img src="images/equipo/ever.jpg"> <!-- random image -->
    <div class="caption left-align">
        <h3 class="oswaldo">Lefd. Everado Gumeta</h3>
        <h5 class="light grey-text text-lighten-3 thin">"Aunque la gimnasia es un deporte de competencia, yo lo veo mas enfocado a una constante competencia con uno mismo"</h5>
    </div>
</li> --}}

       {{--<li>--}}
        {{--<img src="images/equipo/Jose.jpg"> <!-- random image -->--}}
        {{--<div class="caption left-align">--}}
          {{--<h3 class="oswaldo">Lefd. Jose Alfonso Esponda</h3>--}}
          {{--<h5 class="light grey-text text-lighten-3">"Llevo 20 años de entrenador de Gimnasia Artistica, me enfoque en la carrera de entrenamiento deportivo"</h5>--}}
        {{--</div>--}}
      {{--</li>--}}

    </ul>
  </div>
@endsection

@section('scripts')    
    <script src="js/equipo.js"></script>

    <!--Materializewcss Slider-->
          <script>
              $(document).ready(function () {
                  $('.slider').slider({full_width: false});
              });
          </script>  

@endsection
    
