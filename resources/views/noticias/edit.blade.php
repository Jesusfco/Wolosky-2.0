@extends('layouts.app')

@section('content')

    

    <div class="panel panel-default" id="principal">
        <div class="panel-heading"><h2>Noticias >> Editar</h2></div>
        @if(session()->has('msj'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Exito!</strong> La noticia ha sido editada.
              </div>
        @endif
        @if(session()->has('error'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Error!</strong> La noticia no se ha podido editar.
              </div>
        @endif

        @if(isset($noticia))


        <div class="panel-body">
            <form role="form" method="POST" action="{{ url('admin/noticias', $noticia->id )}}" enctype="multipart/form-data" onsubmit="crearNoticia()">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <div class="form-group">
                  <label for="exampleInputEmail1">Titulo</label>
                  <input type="text" name="titulo" class="form-control" value='{{ $noticia->TITULO }}' placeholder="Titulo de la noticia" required>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Resumen</label>
                  <input type="text" name="resumen" class="form-control" value='{{ $noticia->RESUMEN }}' placeholder="Escribe brevemente de que se trara la noticia" required>
                </div>

                <div class="form-group" >
                  <label>Imagen</label>
                  <input type="file" name="imagen"  accept="image/x-png,image/gif,image/jpeg">
                  <p class="help-block">Cargue una fotografía de la noticia</p>
                </div>

                <div class="row"><div class="col-sm-12 col-lg-3">

                 <div class="form-group">
                  <label>Fecha</label>
                  <input type="date" name="fecha" class="form-control" value="{{ $noticia->FECHA }}" required>
                   
                </div>

                </div></div>

                <label>Redacta tu noticia</label>

                <textarea name="editor1" id="editor1" rows="10" cols="80">
                    {{ $noticia->TEXTO }}
                </textarea>
                <input type="hidden" id="contenidoNota" name="texto">


<!--                    --><?php
//                        $text = $noticia->TEXTO;
//                        $breaks = array("<br />","<br>","<br/>");
//                        $text = str_ireplace($breaks, "\r\n", $text);  ?>
<!--                -->



                <div class="form-group">
                  <label>Iframe de Youtube</label>
                  <input type="text" name="youtube" class="form-control" name="YOUTUBE" value='{{ $noticia->YOUTUBE }}' required>
                </div>


                <button type="submit" class="btn btn-default">Editar Nota</button>

                {{ csrf_field() }}
              </form>

            </div>

            @endif
    </div>

            

@endsection

@section('scripts')
    <script src="//cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace( 'editor1' );

        function crearNoticia(){
            var data = CKEDITOR.instances.editor1.getData();
//            console.log(data);

            $('#contenidoNota').val(data);
//            alert('holi');
//            return false;
        }
    </script>
@endsection