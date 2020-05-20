@extends('layouts.visitor')
     
@section('title')
    <title>¿Qué es la gimnasia? - Wolosky - Gimnasia Artística - Tuxtla Gutierrez, Chiapas</title>
@endsection

@section('css')  
<link rel="stylesheet" type="text/css" href="css/gimnasia.css">
@endsection

@section ('content')
<div class="parallax-container">
    <div class="parallax"><img src="images/gimnasia/1.jpg"></div>
  </div>
      
<div class="container">
    <h2>¿Qué es la gimnasia?</h2>
    <p>La Gimnasia es una disciplina deportiva donde se ejecutan secuencias sistemáticas de ejercicios físicos con el fin de desarrollar determinadas habilidades corporales.</p>    
    <p>Esas habilidades corporales varían según la modalidad concreta de Gimnasia, pero en general se trata de fuerza, equilibrio, flexibilidad, agilidad, resistencia y control. Pero no sólo eso. También facilita el desarrollo de habilidades mentales como la alerta, la precisión, la autodisciplina o la confianza en sí mismo.</p>
    <p>Si nos ceñimos a la Gimnasia Deportiva, las disciplinas que actualmente están reconocidas por la Federación Internacional de Gimnasia (FIG) son 6: Artística, Rítmica, Trampolín, Aeróbica, Acrobática y General. Sólo las 3 primeras son olímpicas. También existen otras que no están avaladas por este organismo.</p>

    <h4>Origen de la gimnasia</h4>
    <p>Los origenes se romontan a la antigûedad. Y es que los egipcios ya la practicaron con carácter ritual. Los chinos, allá por el s. XVII a.C. también crearon un sistema de Gimnasia basado en la postura correcta del cuerpo y la respiración. Y por supuesto los griegos, que buscaron la perfección y la belleza física mediante un sistema de ejercicios compuesto por carreras, saltos, lucha, natación y lanzamientos. Posteriormente se convirtió en un método para preparar a sus guerreros no sólo de manera física sino también mental.</p>
    <p>Pero si nos centramos en la Gimnasia Moderna, nació en Alemania a finales del s. XVIII y principios del XIX. Johann Friedrich y Friedrich Jahn, educadores físicos, diseñaron ejercicios para niños y jóvenes utilizando una serie de aparatos inventados por ellos mismos con un fin pedagógico.</p>
    <p>Posteriormente el coronel español Francisco Amorós introdujo esta Gimnasia Educativa en Francia y España y la Gimnasia fue derivando hacia un uso deportivo. Tanto que en 1881 se fundó lo que hoy se conoce como FIG y cuando en 1896 se organizaron los primeros Juegos Olímpicos ya era lo suficientemente popular como para ser incluida. Eso sí, con ejercicios bastante distintos a los que podemos ver ahora: Escalada de Cuerda, Escalera Horizontal, Equipos Sincronizados, Salto de Altura…</p>
    <p>En 1920 las mujeres también empezaron a practicarla y en Ámsterdam 1928 participaron en unos Juegos Olímpicos por primera vez. Dos ediciones más tarde, en Berlín 1936 se incorporó la Gimnasia Rítmica que había empezado a coger fuerza a principios de siglo. Aunque no fue hasta 1962 que la FIG  la reconoció como deporte independiente bajo el nombre de Gimnasia Moderna.</p>
</div>


    
@endsection

@section('scripts')
<!--<script src="js/subscripcion.js">-->
    <script>
    $(document).ready(function(){
        $('.parallax').parallax();
      });
      </script>
@endsection