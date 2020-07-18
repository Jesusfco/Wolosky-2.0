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
    
