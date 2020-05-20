<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="{{url('images/icon.ico')}}"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - Wolosky Panel</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ url('css/materialize.min.css')}}" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="{{ asset('css/panel.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>    
    <link rel="stylesheet" type="text/css" href="{{ url('fonts2/style.css')}}">
    @yield('styles')

<!-- Scripts -->
    <script>
        // window.Laravel = {{ json_encode([ 'csrfToken' => csrf_token(),  ])}}         
    </script>
</head>
<body>

    @include('layouts.menuAdmin')

    <div class="flex "> 
               
      <div class="panelNavFake"></div>                

      <div class="container">
        @yield('content')
      </div>
    </div>
    

    <br>



    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/vue"></script> --}}
    {{-- <script src="{{ url('js/materialize.min.js')}}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="{{ asset('assets/sweet/sweetalert.min.js')}}"></script>
    <script src="{{ asset('js/admin/delete.js')}}"></script>
    <script>

        function toogleMenu() {
        $("#panelNav").toggleClass("active")
        }


        const actualUrl = "{{ url()->current() }}"
        const baseUrl = "{{ url('/') }}"

            $(document).ready(function(){                
                // $('select').formSelect();
                // $('.fixed-action-btn').floatingActionButton();
                $('.tooltipped').tooltip();
            })
            
            @if(session('msj'))    
                M.toast({html: '{{session('msj')}}', displayLength: 5000})        
            @endif

            @if(session('error'))    
                M.toast({html: '{{session('error')}}', classes: 'red', displayLength: 6500})        
            @endif
            @if(session('success'))    
                M.toast({html: "{{ session('success') }}", classes: 'green', displayLength: 6500})        
            @endif

    </script>

    @yield('scripts')
</body>
</html>
