@extends('layouts.default')
    @section('title')
        <title>Quienes Somos Wolosky - Gimnasia Artística - Tuxtla Gutierrez, Chiapas</title>
    @endsection
    
    @section('css')
        <link rel="stylesheet" type="text/css" href="css/quienes.css">
    @endsection
    
@section('content') 
                  
    <div id="fondoquienes">
        <img src="images/quienes/portada.jpg">
    </div>
         
  
    
<div id="contenedorPrincipal">    
    
    <h2  class="light" align="center">¿Quienes somos?</h2> 
    <div class="container" style="max-width: 1000px">  
            <br><br><br>
            <div class="row" id="profesora">
                <div class="col s12 l6">
                    <center>
                        <img src="{{url('images/quienes/rebe.jpg')}}" class="circle responsive-img">
                    </center>
                </div>
                <div class="col s12 l6">
                    <br>
                    <h3 class="oswaldo">Lic.Rebeca Wolosky Álvarez</h3>
                    <h5 class="light text-lighten-3 ">"Hola a todos, soy la fundadora de la Academia de Gimnasia Wolosky con mas de 30 años de sus inicios"</h5>
                </div>
            </div>
              
            <h3 align="center" class="">Somos una Academia de Gimnasia formalmente constituidos</h3>        
            <p align="center">Estamos totalmente conscientes que el logro de cada atleta está basado en un trabajo conjunto y coordinado entre: gimnasta, padres, entrenadores y club.</p>                
          
        
        <div class="hide-on-small-and-down ">
            <h3 class="center tit">Mision</h3>
            <div class="row valign-wrapper">                
                <div class="col s12 m6 valign ">
                    <p class="baja" align="center">  "Lograr que todos nuestros alumnos sean triunfadores, brindándoles seguridad para vencer los retos que enfrenten día con día; fortaleciendo su autoestima para que en su edad adulta sean hombres y mujeres de carácter firme, deportistas sanos, con principios cimentados y bases sólidas que los alejen de cualquier desviación."</p>
                </div>                     
                <div class="col s12 m6 grande">         
                    <center><img src="images/quienes/mision.jpg" class="center responsive-img materialboxed centrado"></center>
                </div>      
            </div>

            <h3 align="center" class="tit">Vision</h3>

            <div class="row valign-wrapper ">
                <div class="col s12 m6 center"> 
                    <img src="images/quienes/vision.jpg" class="responsive-img materialboxed centrado">
                </div>
                <div class="col s12 m6 valign">
                    <p align="center">  "Lograr que todos nuestros alumnos sean triunfadores, brindándoles seguridad para vencer los retos que enfrenten día con día, fortaleciendo su autoestima para que en su edad adulta sean hombres y mujeres de carácter firme, deportistas sanos, con principios cimentados y bases sólidas que los alejen de cualquier desviación."</p>
                </div>                
            </div>
        </div>
            
        <div class="hide-on-med-and-up ">
            <h3 class="center tit">Mision</h3>                                                                                                              
            <center><img src="images/quienes/mision.jpg" class="center responsive-img materialboxed centrado"></center>
            <p class="baja" align="center">  "Lograr que todos nuestros alumnos sean triunfadores, brindándoles seguridad para vencer los retos que enfrenten día con día; fortaleciendo su autoestima para que en su edad adulta sean hombres y mujeres de carácter firme, deportistas sanos, con principios cimentados y bases sólidas que los alejen de cualquier desviación."</p>
                            
            <h3 align="center" class="tit">Vision</h3>                            
            <img src="images/quienes/vision.jpg" class="responsive-img materialboxed centrado">                                
            <p align="center">  "Lograr que todos nuestros alumnos sean triunfadores, brindándoles seguridad para vencer los retos que enfrenten día con día, fortaleciendo su autoestima para que en su edad adulta sean hombres y mujeres de carácter firme, deportistas sanos, con principios cimentados y bases sólidas que los alejen de cualquier desviación."</p>                
            
        </div>    
  
        <h3 class="center tit">Valores</h3>

        <div class="row">
            <div class="col s12 l8 offset-l2">
                <ul class="collapsible popout" data-collapsible="accordion">
                    <li>
                        <div class="collapsible-header active"><i class="material-icons">W</i>Excelencia</div>
                        <div class="collapsible-body"><p>Es de vital importancia la motivación 
                                            del gimnasta en relación al sistema de 
                                            entrenamiento puesto que es la pieza clave para 
                                            que funcione y no se convierta en un frustración</p></div>
                    </li>
                    <li>
                      <div class="collapsible-header"><i class="material-icons">O</i>Calidad</div>
                      <div class="collapsible-body"><p>Calidad personal es la característica de la persona que, 
                                                    manteniendo su autoestima, es capaz de satisfacer expectativas 
                                                    de las personas con las que se relaciona. Alguien con calidad 
                                                    personal, tendrá la inteligencia de poder fomentar amistad,
                                                     relacionarse con la sociedad y mantener un equilibrio en la toma de sus decisiones, 
                                                     teniendo en cuenta si su emoción será inteligente.</p></div>
                    </li>
                    <li>
                      <div class="collapsible-header"><i class="material-icons">L</i>Responsabilidad</div>
                      <div class="collapsible-body"><p>La responsabilidad es el cumplimiento de las obligaciones o cuidado al hacer 
                                                  o decidir algo, o bien una forma de responder que implica el claro conocimiento 
                                                  de que los resultados de cumplir o no las obligaciones, recaen sobre uno mismo.</p></div>
                    </li>
                    <li>
                      <div class="collapsible-header"><i class="material-icons">O</i>Lealtad</div>
                      <div class="collapsible-body"><p>La lealtad es un principio que consiste en nunca darle la espalda a determinada
                                               persona o grupo social o incluso un deporte, que están unidos por lazos de amistad o por alguna relación social, es decir, 
                                               el cumplimiento de honor y gratitud, la lealtad está más apegada a la relación en grupo.</p></div>
                    </li>
                    <li>
                      <div class="collapsible-header"><i class="material-icons">S</i>Honestidad</div>
                      <div class="collapsible-body"><p>El simple respeto a la verdad en relación con el mundo exterior, los hechos y las personas; 
                                        en otros sentidos la honestidad también implica la relación entre el sujeto y los demás, y del sujeto consigo mismo.</p></div>
                    </li>
                    <li>
                      <div class="collapsible-header"><i class="material-icons">K</i>Respeto</div>
                      <div class="collapsible-body"><p> Todas las personas se les debe respeto por el simple hecho de ser personas, o dicho de otra forma por ser seres racionales libres.</p></div>
                    </li>
                    <li>
                      <div class="collapsible-header"><i class="material-icons">Y</i>Eficiencia</div>
                      <div class="collapsible-body"><p>Creemos que nuestros sistemas de entrenamiento buscan generar habilidades solidas en el gimnasta aprovechando cada parte del entrenamiento y comprendiendo las fortalezas y las debilidades de cada persona.</p></div>
                    </li>
                </ul>
            </div>                
        </div>
     </div> 
    <br>
    </div>
</div>      

     


@endsection

@section('scripts')    
  <script src="js/quienes.js"></script>   
@endsection

