<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Usuarios</title>
</head>
<body>
    <h1>Usuarios</h1>
<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Tipo</th>
        <th>Fecha de Nacimiento</th>
        <th>CURP</th>
        <th>Sexo</th>
        <th>Teléfono</th>
        <th>Correo</th>
        <th>Seguro</th>
        <th>Dirección</th>
        <th>Lugar de Nacimiento</th>
        <th>Status</th>
        
    </tr>
    @foreach($users as $r)
    <tr>
        <th>{{$r->id}}</th>
        <th>{{$r->name}}</th>
        <th>{{$r->user_type()}}</th>
        <th>{{$r->birthday}}</th>
        <th>{{$r->curp}}</th>
        <th>{{$r->genderView()}}</th>
        <th>{{$r->phone}}</th>
        <th>{{$r->email}}</th>
        <th>{{$r->insurance}}</th>
        <th>{{$r->fullAddress()}}</th>
        <th>{{$r->placeBirth}}</th>  
        <th>{{$r->statusView()}}</th>        
    </tr>
    @endforeach
</table>
</body>
</html>