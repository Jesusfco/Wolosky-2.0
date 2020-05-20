@extends('layouts.visitor')
     
@section('title')
    <title>Suscribete Wolosky - Gimnasia Artística - Tuxtla Gutierrez, Chiapas</title>
@endsection

@section ('content')


@if(session()->has('msj'))
    <script> alert('Tus datos han sido guardados'); </script>
@endif
@if(session()->has('error'))
    <script> alert('Error'); </script>
@endif

    <div class="container">
            <h1 class="center-align">Suscríbete</h1>             
            <div class="row">
                <div class="col l10 m8 s12 offset-l1 offset-m2">
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title" style="font-weight: bold;"></span>
                            <form  method="POST" action="{{ url('/clientes')}}">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">perm_identity</i>
                                        <input  name="nombre" placeholder="Introduce tu nombre" id="first_name" required="required" type="text" class="validate">
                                        <label for="first_name">Nombre completo</label>
                                    </div>                                    
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">email</i>
                                        <input id="email" name="email"required="required" type="email" class="validate">
                                        <label for="email" data-error="Introducir e-mail válido" data-success="Correcto! :D">Email</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">perm_identity</i>
                                        <select id="gender" name="sexo">
                                            <option disabled selected value>-- Seleccionar género --</option>
                                            <option value="male">Masculino</option>
                                            <option value="female">Femenino</option>
                                        </select>
                                        <label>Sexo</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col l4 s12">
                                        <i class="material-icons prefix">phone</i>
                                        <input name="telefono" id="cellphone" type="text" required="required" pattern="[\d]{10}" title="Introduzca un celular válido" maxlength="10" length="10">
                                        <label for="cellphone">Celular</label>
                                    </div>
                                    
                                    <div class="input-field col l4 s12">
                                        <i class="material-icons prefix">perm_contact_calendar</i>
                                        <input type="date" class="datepicker" name="nacimiento">
                                        <label>Fecha de nacimiento</label>
                                    </div>
                                    
                                    <div class="input-field col l4 s12">
                                        <i class="material-icons prefix">info</i>
                                        <select id="type" name="tipo">
                                            <option disabled selected value>-- Seleccionar un tipo --</option>
                                            <option>Estudiante</option>
                                            <option>Padre de familia</option>
                                        </select>
                                        <label>Tipo</label>
                                    </div>
                                </div>
                               
                                <div class="center-align">
                                    <button class="btn waves-effect waves-light" type="submit" name="action">Enviar
                                        <i class="material-icons right">send</i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
   
<br><br><br>
@endsection

@section('scripts')
<script src="js/subscripcion.js"></script>
@endsection