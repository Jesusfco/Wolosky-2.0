
    <h3>Estudiantes Pendientes</h3>
    <table>
        <thead>
        <tr>
            <th>Alumno</th>
            <th>Mensualidad</th>
            {{-- <th>Ultima Mensualidad</th> --}}
        </tr>
        </thead>
        <tbody>
            @foreach($users as $obj)
            <tr>
                <td>{{ $obj->name}}</td>
                <td>{{ $obj->monthly_payment->amount}}</td>
                {{-- <td></td> --}}
            </tr>
                @endforeach
        </tbody>
    </table>
        