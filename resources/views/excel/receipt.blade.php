<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Recibos </h1>
<table>
    <tr>
        <th>ID</th>
        <th>CREADOR</th>
        <th>ALUMNO</th>
        <th>MONTO</th>
        <th>MES</th>
        <th>FECHA DE PAGO</th>
        <th>TIPO</th>
        <!-- <th>TIPO</th> -->
    </tr>
    @foreach($receipt as $r)
    <tr>
        <th>{{$r->id}}</th>
        <th>{{$r->creator_id}}</th>
        <th>{{$r->user_id}}</th>
        <th>{{$r->amount}}</th>
        <th>{{$r->month}}</th>
        <th>{{$r->created_at}}</th>
        <th>{{$r->type}}</th>
        <!-- <th>TIPO</th> -->
    </tr>
    @endforeach
</table>
    
</body>
</html>