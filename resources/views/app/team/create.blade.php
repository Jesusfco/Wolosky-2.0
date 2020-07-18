@extends('layouts.app')

@section('content')  

<h5><a href="/admin/equipo">Equipo</a> / Crear </h5>

<form role="form" method="POST" enctype="multipart/form-data" class="row">
    {{ csrf_field() }}

    <div class="col l12">
      <label for="exampleInputEmail1">Nombre</label>
      <input type="text" name="name" class="form-control" maxlength="100" required>
    </div>

    <div class="col l12">
      <label for="exampleInputPassword1">Frase</label>
      <input type="text" name="sentence" class="form-control" maxlength="180" required>
    </div>
    

    <div class=" col l4 s6">
      <label>Imagen *</label>
      <div class="file-field input-field">
        <div class="btn">
          <span>Imagen</span>
          <input type="file" accept="image/x-png,image/gif,image/jpeg" name="imgFile" required>
        </div>
        <div class="file-path-wrapper">
          <input class="file-path validate" type="text">
        </div>
      </div>
    </div>        
    
    <div class="col l4 s6">
      <label>Estado</label>
      <select class="browser-default">        
        <option value="1">Activo</option>
        <option value="0">Inactivo</option>        
      </select>
    </div>
                     

    <div class="col l12">                              
      <button type="submit" class="btn blue">Enviar Información</button>
    </div>
    
  </form>
               
@endsection

@section('scripts')  
  <script>

  </script>
@endsection