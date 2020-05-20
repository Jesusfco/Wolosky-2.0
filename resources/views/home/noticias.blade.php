@extends('layouts.default')
    
@section('title')
    <title>Wolosky Noticias - Gimnasia Artística - Tuxtla Gutierrez, Chiapas</title>
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ url('css/logros.css')}}">
@endsection

@section('content')  


<br><br>
<div class="row content">
    <div class="col s12 l8"> 
  

    @if(isset($noticias))    
        @foreach($noticias as $n)        
            <div class="row">
                <div class='col s12 m5 divImg'>                      
                    <a href='noticias/{{ $n->id }}'>
                        <img class='activator responsive-img' src='{{ $n->getImgUrl() }}'>
                    </a>
                </div>
                <div class='col s12 m7'>
                    <a href='noticias/{{ $n->id }}'><h5 class="tituloNoticia">{{ $n->titulo }}</h5></a>
                    <p>{{ substr($n->resumen, 0, 140)}}...</p>
                           <a href='noticias/{{ $n->id }}'   class='btn waves-effect waves-light red darken-4'>Leer más..</a>
                </div>                                    
            </div>  
        <hr>
        @endforeach
    
        <center>


            <ul class="pagination">
                <!-- Previous Page Link -->
                @if ($noticias->onFirstPage())
                    <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
                @else
                    <li class="waves-effect"><a href="{{ $noticias->previousPageUrl() }}"><i class="material-icons">chevron_left</i></a></li>

                @endif

            <!-- Pagination Elements -->
               @for($i=1; $i <= $noticias->lastPage(); $i++)
                   @if($i == $noticias->currentPage())
                        <li class="blue white-text"><a href="#!" class=" white-text">{{$i}}</a></li>
                    @else
                        <li class="waves-effect"><a href="{{url('noticias?page=' .  $i) }}">{{$i}}</a></li>
                    @endif
               @endfor

            <!-- Next Page Link -->
                @if ($noticias->hasMorePages())
                    <li class="waves-effect"><a href="{{ $noticias->nextPageUrl() }}"><i class="material-icons">chevron_right</i></a></li>
                @else
                    <li class="disabled"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
                @endif
            </ul>

        </center>
        @endif
    </div> 
    <div class="col m12 l4 social">
        <h5 style="margin-top: 0px;">Facebook</h5>
        <div>

            <div class="fb-page" data-href="https://www.facebook.com/GimnasiaWolosky/" data-tabs="timeline" data-height="500" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/GimnasiaWolosky/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/GimnasiaWolosky/">Gimnasia Artistica WOLOSKY</a></blockquote></div>

            <br>
        </div>
        <h5>Tweeter</h5>
            <a class="twitter-timeline" data-width="350" data-height="600" data-theme="dark" data-link-color="#2B7BB9" href="https://twitter.com/Rebewolosky">Tweets by Rebewolosky</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>        
    </div>
</div>    

@endsection

@section('scripts')

    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.10&appId=1775131872727466";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

@endsection
