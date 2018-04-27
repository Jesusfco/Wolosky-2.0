<h1>Deudores </h1>
<table>
    <tr>
        <th>ID</th>
        <th>DEUDOR</th>        
        <th>MONTO</th>
        <th>STATUS</th>
        <th>F/H creacion de registro</th>
        
        
    </tr>
    @foreach($debts as $d)
    <tr>

        <th>{{$d->id}}</th>        
        <th>{{$d->user_name}}</th>
        <th>{{$d->total}}</th>
        <th>{{$d->status}}</th>
        <th>{{$d->created_at}}</th>        
        
    </tr>
    @endforeach
</table>