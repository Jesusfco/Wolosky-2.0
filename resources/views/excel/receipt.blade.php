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
        <th>ALUMNO</th>
        <th>MONTO</th>
        <th>MES</th>
        <th>TIPO</th>
        <th>FECHA-HORA CREACIÓN DE RECIBO</th>
        <th>FECHA-HORA ULTIMA ACTUALIZACIÓN</th>
        <th>CREADOR</th>
        
        <!-- <th>TIPO</th> -->
    </tr>
    @foreach($receipt as $r)
    <tr>
        <th>{{$r->id}}</th>        
        <th>{{$r->user->name}}</th>
        <th>{{$r->amount}}</th>
        <th>{{$r->month}}</th>
        <th>{{$r->typeView()}}</th>
        <th>{{$r->created_at}}</th>
        <th>{{$r->updated_at}}</th>
        <th>{{$r->creator->name}}</th>        
    </tr>
    @endforeach
</table>
    
</body>
</html>