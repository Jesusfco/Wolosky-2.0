@extends('layouts.default')
        
@section('title')
    <title>{{ $noticias->titulo }} - Wolosky Noticias - Gimnasia Artística - Tuxtla Gutierrez, Chiapas</title>
@endsection        
@section('css')  
    <meta property="og:url"                content="{{ url('noticias', $noticias->id)}}" />
    <meta property="og:type"               content="article" />
    <meta property="fb:app_id"               content="1087647381316356" />
    <meta property="og:title"              content="{{ $noticias->titulo }}" />
    <meta property="og:description"        content="{{ $noticias->resumen }}" />
    <meta property="og:image"              content="{{ url('images/noticias/' . $noticias->id . '/' . $noticias->img) }}" />

    <link rel='stylesheet' type='text/css' href='../css/noticias.css'>

    <link rel="stylesheet" type="text/css" href="{{ asset('gallery/css/blueimp-gallery.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('gallery/css/blueimp-gallery-indicator.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('gallery/css/blueimp-gallery-video.css') }}">
    
@endsection    
@section('content')
                <br>


<div id="app">           

<input type="hidden" value="{{$noticias->id}}" id="galleryId">
<input type="hidden" value="{{url('/')}}" id="homePath">

    <div class="row z-depth-5 content">
        
      <div class=' col s12 l8 white'>
        <div class='col s12 l10 offset-l1'>
            <blockquote>
                <h1 class='thin black-text titulo'> 
                    {{ $noticias->titulo }}
                </h1>
                <div class='col s1'>
                      <i class='small material-icons'>today</i> 
                </div>
                <div class='fecha' >
                    <p class='fecha'>{{ $noticias->fecha }}</p>
                </div>
            </blockquote>
        </div>
                
         <div class='col s12 l10 offset-l1'>
            <img class='materialboxed' src='../images/noticias/{{ $noticias->id }}/{{ $noticias->imagen }}' width='100%'>
        </div>

        <div class='row col s12 l8 offset-l1'>
            <blockquote>
            {{ $noticias->resumen }}
            </blockquote>
        </div>

        <div class='row'>
            <div class='col s12  l10 offset-l1'>
                <div style="display: none;">{{ $texto = $noticias->texto }}</div>
                <?php echo $texto; ?>
            </div>
        </div>

        <div style="display: none;">{{ $youtu = $noticias->youtube}}</div>
        <div class='col s12 l8 offset-l2'> 
          <div class='video-container'><?php echo $youtu; ?></div>
        </div>

        <!--Facebooks Scripts       -->
        <div id='fb-root'></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = '//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.8&appId=1087647381316356';
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>


        <div class='row col s12 l8 offset-l2'>
            <div class='fb-like' data-href='http://www.woloskygimnasia.com/noticias/{{ $noticias->id }}' data-layout='standard' data-action='like' data-size='small' data-show-faces='true' data-share='true'></div>
        </div>


        <h3 align="center" v-if="photos.length > 0">FOTOS</h3>

        <div v-if="photos.length > 0" class="photoContainer" id="links">

            <a v-for="photo in photos" class="photo" v-bind:href="photo.path" data-gallery="#blueimp-gallery-links">

                <div v-bind:id="'pho-' + photo.id" class="backgroundPhoto"></div>

            </a>
        
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

        <div class='row'>
            <div class='col s12 l8 offset-l2'>
                <!-- Facebooks comentarios -->
                <div class='fb-comments' data-href='http://www.woloskygimnasia.com/noticias/{{ $noticias->id }}.php' data-numposts='5'></div>
            </div>
        </div>
        
        @if(isset($not))
        <div class="row social hide-on-large-only hide-on-small-only">
            <h4>Mas Noticias</h4>
        @foreach($not as $n)
        
            <div class="col m6">
            <a href="{{ $n->id}}">
                <div class="interes">
                    <img src="../images/noticias/{{ $n->id }}/{{ $n->imagen }}" class="responsive-img">
                </div> 
            </a>
            <h5> {{ $n->titulo}} </h5>
            <hr>
            </div>
        
        @endforeach
        </div>
        @endif
    </div>
          
    <div class="col m12 l4 social hide-on-med-only">
        <div class="hide-on-med-and-down">
            <h4 class="">Facebook</h4>
            <div class="fb-page" data-href="https://www.facebook.com/GimnasiaWolosky/" data-tabs="timeline" data-height="500" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/GimnasiaWolosky/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/GimnasiaWolosky/">Gimnasia Artistica WOLOSKY</a></blockquote></div>
            <h4 class="">Tweeter</h4>
                <a class="twitter-timeline " data-width="350" data-height="400" data-theme="dark" data-link-color="#2B7BB9" href="https://twitter.com/Rebewolosky">Tweets by Rebewolosky</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
        </div>
        <h4>Mas Noticias</h4>
        
        @if(isset($not))
        @foreach($not as $n)
            <a href="{{ $n->id}}">
                <div class="interes">
                    <img src="../images/noticias/{{ $n->id }}/{{ $n->imagen }}" class="responsive-img">
                </div> 
            </a>
            <h5> {{ $n->titulo}} </h5>
            <hr>
        @endforeach
        @endif
        
    </div>
    
    </div>
</div>    
    @endsection
    @section('scripts')           

        <script src="https://unpkg.com/imagesloaded@4.1/imagesloaded.pkgd.min.js"></script>
        <script src="{{ asset('gallery/js/blueimp-helper.js') }}"></script>
        <script src="{{ asset('gallery/js/blueimp-gallery.js') }}"></script>
        <script src="{{ asset('gallery/js/blueimp-gallery-fullscreen.js') }}"></script>
        <script src="{{ asset('gallery/js/blueimp-gallery-indicator.js') }}"></script>
        <script src="{{ asset('gallery/js/jquery.blueimp-gallery.js') }}"></script>
        <script>
            document.getElementById('links').onclick = function (event) {
                event = event || window.event;
                var target = event.target || event.srcElement,
                    link = target.src ? target.parentNode : target,
                    options = {index: link, event: event},
                    links = this.getElementsByTagName('a');
                blueimp.Gallery(links, options);
            };
        </script>
        <script>
        $(document).ready(function(){

             $('.materialboxed').materialbox();
           });
        </script>          
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/vue"></script> -->
        <script src="https://unpkg.com/axios@0.12.0/dist/axios.min.js"></script>
        <script src="https://unpkg.com/lodash@4.13.1/lodash.min.js"></script>
        <script type="text/javascript" src="{{ asset('js/articulo.js') }}"></script>    

        

        
    @endsection