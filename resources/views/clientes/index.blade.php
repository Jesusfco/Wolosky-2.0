@extends('layouts.app')
@section('styles')
    <link href="{{url('sweet/sweetalert.css')}}" rel="stylesheet">
@endsection
@section('content')               

            <div class="panel panel-default" id="principal">
                <div class="panel-heading">
                    <div class="row">
                    
                    <div class="col-xs-12 col-sm-6">                 
                    <h2>Clientes >> Lista</h2>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        
                    <form method="GET" class="navbar-form">
                         <div class="input-group">
                            <input name="name" class="form-control" placeholder="Buscar Cliente">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">Buscar</button>
                            </span>
                        </div>
                    </form>     
                        
                    </div></div>
                    
                    
                </div>

                <div class=" responsive-table">
                    <table class="table table-hover table-condensed ">
                        <thead>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Sexo</th>
                            <th>Telefono</th>
                            <th>Edad</th>
                            <th>Nacimiento</th>
                            <th>Tipo</th>
                            <th>Acciones</th>
                        </thead>
                        <tbody>
                        @foreach($clientes as $n)
                        <tr id="cliente{{$n->id}}">
                            <td>{{ $n->nombre }}</td>
                            <td>{{ $n->email }}</td>
                            <td>{{ $n->sexo }}</td>
                            <td>{{ $n->telefono }}</td>
                            <td>{{ $n->edad }}</td>
                            <td>{{ $n->nacimiento }}</td>
                            <td>{{ $n->tipo }}</td>
                            <td>
                                <a href="{{ url('/clientes/'.$n->id.'/edit') }}" class="btn btn-primary btn-xs">Editar </a>
                                <a  onclick="eliminar({{ $n->id }}, '{{ $n->nombre }}')" class="btn btn-danger btn-xs"> Eliminar</a>
                                
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>                
                    <center>
                        {{ $clientes->links() }}
                    </center> 
                </div>
            </div>

            

@endsection

<script src="{{url('sweet/sweetalert.min.js')}}"></script>
<script src="{{url('js/Aplication/clientesList.js')}}"></script>

