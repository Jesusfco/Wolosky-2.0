@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/dropzone.css') }}">
@stop
@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/vue"></script> -->
<script src="https://unpkg.com/axios@0.12.0/dist/axios.min.js"></script>
<script src="https://unpkg.com/lodash@4.13.1/lodash.min.js"></script>
<script type="text/javascript" src="{{ asset('js/Aplication/myDropzoneNoticias.js') }}"></script>

@endsection

@section('content')

    

<div class="panel panel-default" id="principal">
    <div class="panel-heading"><h2>Noticias >> Cargar Fotos</h2></div>
        <div class="panel-body">

            <h2>{{ $noticia->titulo }}</h2>

            <div id="app">

                <h5>Añada sus imágenes</h5>

                <div class="opciones"> 
                    <button v-on:click="retryFiled" class="ui mini button purple">Reintentar Carga</button>
                </div>


                <form id="drop" method="POST">
                    <div  class="dropInputContainer">
                        <input id="files" type="file" name="files" v-on:change="getFile" multiple>
                        <img src="http://www.lilianapineda.com/images/aplication/uploadIcon.png">
                    </div>
                    
                    {{ csrf_field() }}

                    <div class="filePreviewContainer" v-if="files.length > 0" >
                        <div v-for="file in files" class="fileDiv" v-bind:class="{ activeDrop: file.status == 1, 
                        'errorUpload': file.status < 0 }">
                            <img :src=file.bits :id=file.id>
                            
                            <div v-if="file.status == 1" class="progress">
                                <div class="percent" id="percent"></div>
                            </div>
                            <div v-if="file.status == -1" class="alertDrop">
                                <p>Error en la carga</p>
                            </div>
                            <div v-if="file.status == -2" class="alertDrop">
                                <p>Nombre duplicada</p>
                            </div>
                        </div>
                    </div>    
                </form>

                <br>

                <input type="hidden" value="{{$noticia->id}}" id="galleryId">
                <input type="hidden" value="{{url('/')}}" id="homePath">

                <div id="links" class="photoContainer">

                </div>

                <div id="blueimp-gallery" class="blueimp-gallery">
                    <div class="slides"></div>
                    <h3 class="title"></h3>
                    <a class="prev">‹</a>
                    <a class="next">›</a>
                    <a class="close">×</a>
                    <a class="play-pause"></a>
                    <ol class="indicator"></ol>
                </div>

                <br>
            </div>

        </div>
            
    </div>
</div>

            

@endsection