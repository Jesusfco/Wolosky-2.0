<h1>ASISTENCIAS </h1>
<table>
    <tr>        
        <th>Usuario</th>        
        <th>Fecha</th>
        <th>Entrada</th>
        <th>Salida</th>
        
        
        
    </tr>
    @foreach($records as $obj)
    <tr>

        <th>{{$obj->user->name}}</th>        
        <th>{{$obj->date}}</th>        
        <th>{{$obj->checkIn}}</th>        
        <th>{{$obj->checkOut}}</th>        
        
        
    </tr>
    @endforeach
</table>