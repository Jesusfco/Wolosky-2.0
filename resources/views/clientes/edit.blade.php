@extends('layouts.app')

@section('content')

    

   <div class="panel panel-default" id="principal">
       
       
                <div class="panel-heading"><h2>Cliente >> Editar</h2></div>
                @if(session()->has('msj'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Exito!</strong> Los datos han sido guardados.
                      </div>
                @endif
                @if(session()->has('error'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Error!</strong> No se pudieron almacenar los datos.
                      </div>
                @endif
                <div class="panel-body">
                    <form role="form" method="POST" action="{{ route('clientes.update', $cliente->id)}}">
                        {{ csrf_field() }}
                        {{ method_field('PUT')}}
                        <div class="form-group">
                          <label for="exampleInputEmail1">Nombre Completo</label>
                          <input type="text" name="nombre" class="form-control" value="{{ $cliente->nombre }}" placeholder="Escribe el nombre completo del cliente" required>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Correo</label>
                          <input type="email" name="email" class="form-control"  value="{{ $cliente->email }}" placeholder="ejemplo@gmail.com" required>
                        </div>                        
                        
                        <div class="row">
                            <div class="col-xs-12 col-sm-3">                            
                                <div class="form-group">
                                    <label>Nacimiento</label>
                                    <input value="{{ $cliente->nacimiento }}" type="date" name="nacimiento" class="form-control" required>
                                </div>                        
                            </div>
                            
                            <div class="col-xs-12 col-sm-3">                            
                                <div class="form-group">
                                    <label>Telefono</label>
                                    <input value="{{ $cliente->telefono }}" type="number" name="telefono" class="form-control" placeholder="961-000-0000">
                                </div>                        
                            </div>
                            
                            <div class="col-xs-12 col-sm-3">                            
                                <div class="form-group">
                                    <label>Tipo</label>
                                    <select class="form-control" name="tipo" >
                                        <option>{{ $cliente->tipo }}</option>
                                        <option>Estudiante</option>
                                        <option>Padre de familia</option>                                        
                                    </select>
                                </div>                        
                            </div>
                            
                            <div class="col-xs-12 col-sm-3">                            
                                <div class="form-group">
                                    <label>Sexo</label>
                                    <select class="form-control" name="sexo">
                                        <option>{{ $cliente->sexo }}</option>
                                        <option>Masculino</option>
                                        <option>Femenino</option>                                        
                                    </select>
                                </div>                        
                            </div>
                        </div>                                                        
                        
                        
                        <button type="submit" class="btn btn-default">Modificar Cliente</button>
                      </form>
               
                    </div>
            </div>

            

@endsection