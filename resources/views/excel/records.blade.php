<h1>ASISTENCIAS </h1>
<table>
    <tr>        
        <th>Usuario</th>        
        <th>Fecha</th>
        <th>Entrada</th>
        <th>Salida</th>
        <th>Horas Trabajadas</th>
        
        
        
    </tr>
    @foreach($records as $obj)
    <tr>

        <th>{{$obj->user->name }}</th>        
        <th>{{$obj->date }}</th>        
        <th>{{$obj->checkIn }}</th>        
        <th>{{$obj->checkOut }}</th>
        <th>{{$obj->typeView() }}</th>
        <th>{{$obj->hours_worked }}</th>        
        <th>{{$obj->hours_extra }}</th>        
        <th>{{$obj->hours_observación }}</th>        
        
        
    </tr>
    @endforeach
</table>