@extends('layouts.app')
@section('styles')
    <link href="{{url('sweet/sweetalert.css')}}" rel="stylesheet">
@endsection
@section('content')            

            <div class="panel panel-default" id="principal">
                <div class="panel-heading">
                    <div class="row">
                    
                    <div class="col-xs-12 col-sm-6">
                    <h2>Noticias >> Lista</h2>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        
                    <form method="GET" class="navbar-form">
                         <div class="input-group">
                            <input name="name" class="form-control" placeholder="Buscar Noticia" autofocus>
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
                            <th>ID</th>
                            <th>Titulo</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </thead>
                        <tbody>
                        @foreach($noticias as $n)
                        
                        <tr id="noticia{{$n->id}}">
                            <td>{{ $n->id }}</td>
                            <td>{{ $n->TITULO }}</td>
                            <td>{{ $n->FECHA }}</td>
                            <td>                                
                                <a href="{{ url('/noticias/'.$n->id.'/edit') }}" class="btn btn-primary btn-xs">Editar </a>
                                <a  onclick="eliminar({{ $n->id }}, '{{ $n->TITULO }}')" class="btn btn-danger btn-xs"> Eliminar</a>
                                <a href="{{ url('noticias', $n->id) }}" class="btn btn-success btn-xs" type="button">Ver</a>
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
    <script src="{{url('sweet/sweetalert.min.js')}}"></script>
    <script src="{{url('js/Aplication/noticiasList.js')}}"></script>
@endsection
