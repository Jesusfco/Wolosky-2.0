<h3>Alumnos Regulares</h3>
<table>
    <thead>
    <tr>
        <th>Alumno</th>
        <th>Mensualidad</th>
        <th>Fecha de pago</th>
    </tr>
    </thead>
    <tbody>
        @foreach($users as $obj)
        <tr>
            <td>{{ $obj->name}}</td>
            <td>{{ $obj->monthly_payment->amount}}</td>
            @if( count($obj->receipts) > 0)
                <td>{{ $obj->receipts[0]->created_at }}</td>
            @else
                <td></td>
             @endif
        </tr>
            @endforeach
    </tbody>
</table>