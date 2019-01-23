<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h3>{{ $event->name}}</h3>
    <p>{{ $event->description }} . Costo General ${{ $event->cost }}</p>
    <p>{{ $event->date }} @if($event->date_to != NULL) - {{ $event->date_to}} @endif</p>

    <table>
        <tr>            
            <th>Nombre</th>
            <th>Tipo de Usuario</th>
            <th>Sexo</th>
            <th>Monto a pagar</th>
            
        </tr>
        @foreach($event->participants as $part)
            @if($part->status == 1)

        <tr>
            <th>{{ $part->user->name }}</th>
            <th>{{ $part->user->user_type() }}</th>
            <th>{{ $part->user->genderView() }}</th>
            <th>{{ $part->cost }}</th>                                        
        </tr>

            @endif
        @endforeach
    </table>
</body>
</html>