@extends('layouts.app')

@section('content')

    

    <div class="panel panel-default" id="principal">
        <div class="panel-heading"><h2>Noticias >> Cargar Fotos</h2></div>

        


        <div class="panel-body">

        <h2>{{ $noticia->titulo }}</h2>
            
        </div>
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