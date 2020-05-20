@extends('layouts.app')

@section('content')  

  <h5><a href="/admin/noticias">Noticias</a> / Lista</h5>

  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif

  @if(session()->has('msj'))
    <div class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>Exito!</strong> La noticia ha sido cargada a la base de datos.
    </div>
  @endif

  @if(session()->has('error'))
      <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Error!</strong> La noticia no ha sido cargada.
      </div>
  @endif
              


<form role="form" method="POST" enctype="multipart/form-data" onsubmit="return crearNoticia()" class="row">
    {{ csrf_field() }}

    <div class="col l12">
      <label for="exampleInputEmail1">Titulo</label>
      <input type="text" name="titulo" class="form-control" maxlength="100"  placeholder="Titulo de la noticia" required>
    </div>

    <div class="col l12">
      <label for="exampleInputPassword1">Resumen</label>
      <input type="text" name="resumen" class="form-control" maxlength="180"  placeholder="Escribe brevemente de que se trara la noticia" required>
    </div>
    

    <div class=" col l4 s6">
      <label>Imagen *</label>
      <div class="file-field input-field">
        <div class="btn">
          <span>Imagen</span>
          <input type="file" accept="image/x-png,image/gif,image/jpeg" name="imagen" required>
        </div>
        <div class="file-path-wrapper">
          <input class="file-path validate" type="text">
        </div>
      </div>
    </div>                                                
        
      <div class="col l4 s6">
      <label>Fecha</label>
      <input type="date" name="fecha" class="form-control" id="dateInput" required>
    </div>
                            
    <div class="col l12">
      <label>Redacta tu noticia</label>
      <textarea name="editor1" id="editor1" rows="10" cols="80"></textarea>
      <input type="hidden" class="contenidoNota" name="texto" required>
    </div>
    
    <div class="col l12">
      <label>Link de Youtube</label>
      <input type="text" name="youtube" class="form-control" name="YOUTUBE"  maxlength="180">
    </div>                  

    <div class="col l12">                              
      <button type="submit" class="btn blue">Crear Nueva Noticia</button>
    </div>
    
  </form>
               
@endsection

@section('scripts')
  <script src="//cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
  <script>

    function crearNoticia(){
        var data = CKEDITOR.instances.editor1.getData();
        $('.contenidoNota').val(data);

//            return false;
    }
        
    Date.prototype.toDateInputValue = (function() {
        var local = new Date(this);
        local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
        return local.toJSON().slice(0,10);
    });
    $(document).ready(() => {        
        CKEDITOR.replace( 'editor1' );
        $('#dateInput').val(new Date().toDateInputValue());
    })
    </script>
@endsection