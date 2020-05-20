@extends('layouts.app')
@section('title', 'Noticias')
@section('styles')
    <link href="{{url('sweet/sweetalert.css')}}" rel="stylesheet">
@endsection
@section('content')            

            
    <h5>Noticias / Lista</h5>
    <a href="noticias/create" class="btn orange">Crear Noticia</a>
            
    <form method="GET" class="navbar-form">
        <div class="input-group">
            <input name="name" value="{{ request('name')}}" class="form-control" placeholder="Buscar Noticia" autofocus>                    
            <button class="btn btn-default" type="button">Buscar</button>                            
        </div>
    </form>                               
                
    <div class=" responsive-table">
        <table class="table table-hover table-condensed ">
            <thead>                            
                <th>Titulo</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </thead>
            <tbody>
            @foreach($noticias as $n)
            
            <tr id="id{{$n->id}}">                            
                <td>{{ $n->titulo }}</td>
                <td>{{ $n->fecha }}</td>
                <td>
                    <a href="{{ url('/noticias/'.$n->id.'/edit') }}" class="btn blue">Editar </a>
                    <a  onclick="eliminar({{ $n->id }}, '{{ $n->titulo }}')" class="btn red"> Eliminar</a>
                    <a href="{{ url('noticias', $n->id) }}" class="btn green" type="button">Ver</a>
                    {{-- <a href="{{ url('/noticias/'.$n->id.'/uploadPhotos') }}" class="btn btn-primary btn-xs">Administrar Fotos </a>                                 --}}
                </td>
            </tr>
            
            @endforeach
        </tbody>
        </table>
    </div>
    <center>
        {{ $noticias->links() }}
    </center>

</div>

            

@endsection

@section('scripts')
        
@endsection
