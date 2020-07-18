@extends('layouts.app')
@section('title', 'Noticias')
@section('styles')
    <link href="{{url('sweet/sweetalert.css')}}" rel="stylesheet">
@endsection
@section('content')            

            
    <h5>Equipo / Lista</h5>
    <a href="equipo/create" class="btn orange">Crear </a>
            
    <form method="GET" class="navbar-form">
        <div class="input-group">
            <input name="name" value="{{ request('name')}}" class="form-control" placeholder="Buscar Integrante" autofocus>                    
            <button class="btn btn-default" type="button">Buscar</button>                            
        </div>
    </form>                               
                
    <div class=" responsive-table">
        <table class="table table-hover table-condensed ">
            <thead>                            
                <th>Nombre</th>
                <th>Frase</th>
                <th>Activo</th>
                <th>Acciones</th>
            </thead>
            <tbody>
            @foreach($array as $n)
            
            <tr id="id{{$n->id}}">                            
                <td>{{ $n->name }}</td>
                <td>{{ $n->sentence }}</td>
                <td>{{ $n->activeView() }}</td>
                <td>
                    <a href="{{ url('admin/equipo/edit', $n->id) }}" class="btn blue">Editar </a>
                    <a  onclick="eliminar({{ $n->id }}, '{{ $n->name }}')" class="btn red"> Eliminar</a>
                    {{-- <a href="{{ url('noticias', $n->id) }}" class="btn green" type="button">Ver</a>
                    <a href="{{ url('/noticias/'.$n->id.'/uploadPhotos') }}" class="btn btn-primary btn-xs">Administrar Fotos </a>                                 --}}
                </td>
            </tr>
            
            @endforeach
        </tbody>
        </table>
    </div>
    <center>
        {{ $array->links() }}
    </center>

</div>

            

@endsection

@section('scripts')
        
@endsection
