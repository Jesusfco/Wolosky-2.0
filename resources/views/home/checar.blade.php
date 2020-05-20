@extends('layouts.visitor')
        
@section('title')
 {{-- Wolosky Noticias - Gimnasia Artística - Tuxtla Gutierrez, Chiapas --}}
@endsection        

@section('content')
    <form action="" method="POST">
        {{ csrf_field() }}
        <input name="mensaje" required>
        <button>Enviar</button>
    </form>
@endsection