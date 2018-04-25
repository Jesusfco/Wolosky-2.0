<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>GASTOS </h1>
<table>
    <tr>
        <th>ID</th>
        <th>CREADOR</th>        
        <th>MONTO</th>
        <th>NOMBRE</th>
        <th>DESCRIPCION</th>
        <th>FECHA/HORA REGISTRO CREADO</th>
        <th>FECHA/HORA REGISTRO ACTUALIZADO</th>
        <!-- <th>TIPO</th> -->
    </tr>
    @foreach($expenses as $r)
    <tr>
        <th>{{$r->id}}</th>
        <th>{{$r->creator_id}}</th>        
        <th>$ {{$r->amount}}</th>
        <th>{{$r->name}}</th>
        <th>{{$r->description}}</th>
        <th>{{$r->created_at}}</th>
        <th>{{$r->updated_at}}</th>
        <!-- <th>TIPO</th> -->
    </tr>
    @endforeach
</table>
    
</body>
</html>