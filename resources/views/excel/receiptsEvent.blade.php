<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h4>Recibos del evento: {{ $object['event']->name}}</h3>    

    <table>
        <tr>            
            <th>Participante</th>
            <th>Monto</th>
            <th>Fecha-Hora creacion de recibo</th>
            <th>Creador del Recibo</th>
            
        </tr>
        @foreach($object['receipts'] as $receipt)
            

        <tr>
            <th>{{ $receipt->user->name }}</th>
            <th>{{ $receipt->amount}}</th>
            <th>{{ $receipt->created_at }}</th>
            <th>{{ $receipt->creator->name }}</th>                                        
        </tr>

            
        @endforeach
    </table>
</body>
</html>