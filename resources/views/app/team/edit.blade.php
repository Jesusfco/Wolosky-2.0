@extends('layouts.app')

@section('content')

<h5><a href="/admin/equipo">Equipo</a> / Editar {{ $obj->name }} </h5>
<div style="max-width: 400px; display: block; margin: 0 auto; width: 80%">
  <img style="width: 100%" src="{{ $obj->img_path}}" id="img">
</div>
<form role="form" method="POST" enctype="multipart/form-data" class="row">
    {{ csrf_field() }}

    <div class="col l12">
      <label for="exampleInputEmail1">Nombre</label>
      <input type="text" name="name" class="form-control" maxlength="100" required value="{{ $obj->name }}">
    </div>

    <div class="col l12">
      <label for="exampleInputPassword1">Frase</label>
      <input type="text" name="sentence" class="form-control" maxlength="180" value="{{ $obj->sentence }}" required>
    </div>
    

    <div class=" col l4 s6">
      <label>Imagen *</label>
      <div class="file-field input-field">
        <div class="btn">
          <span>Imagen</span>
          <input type="file" accept="image/x-png,image/gif,image/jpeg" name="imgFile">
        </div>
        <div class="file-path-wrapper">
          <input class="file-path validate" type="text">
        </div>
      </div>
    </div>                                                
       
    <div class="col l4 s6">
      <label>Estado</label>
      <select class="browser-default" name="active">        
        <option value="1" @if($obj->active) selected @endif>Activo</option>
        <option value="0" @if(!$obj->active) selected @endif>Inactivo</option>
        
      </select>
    </div>

    <div class="col l12">                              
      <button type="submit" class="btn blue">Enviar Información</button>
    </div>
    
  </form>
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