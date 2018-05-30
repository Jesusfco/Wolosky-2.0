<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
</head>
<body>

<style>
    * {     
        /* padding: 0;
        margin: 6px; */
        font-family: sans-serif;
    }

    table {
            border-collapse: collapse;
            width: 100%;
            font-size: 11px;
            border: 1;
        }

        th, td {
            text-align: center;
            padding: 2px 8px 2px 8px;
            border-bottom: 1px solid;
        }
        th {
            background-color: #789;
            color: white;            
        }
        tr:nth-child(even){background-color: #f2f2f2}

</style>

<h2>Usuario: {{ $user->name}} </h2>
<p>Correo: {{ $user->email }}</p>
<p>CURP: {{ $user->curp }}</p>
<p>Teléfono: {{ $user->phone }}</p>
<p>Fecha de Nacimiento: {{ $user->birthday}}</p>
<p>Sexo: {{ $user->gender }}</p>
<p>Seguro: {{ $user->insurance }}</p>

@if(isset($monthly))
    <h3>Mensualidad: ${{ $monthly->amount }}</h3>
@endif

<h3>Dirección</h3>

<p> {{ $user->street }}, #{{ $user->houseNumber }}, COLONIA {{ $user->colony }}, CIUDAD {{ $user->city}}<p>

<h3>Horarios</h3>

    <table>
        <thead>
            <tr>
                <th>Dia</th>
                <th>Entrada</th>
                <th>Salida</th>
            </tr>
        </thead>

        <tbody>
        @foreach ($schedules as $che)

            @if($che->active)
            <tr *ngFor="let x of schedules" [ngClass]="{ scheduleInactive: !x.active }">
                            
                <th>{{ $che->day_id }}</th>
                <th>{{ $che->check_in }}</th>
                <th>{{ $che->check_out }}</th>
                
            </tr>
            @endif

        @endforeach
        
        </tbody>
    </table>



    <h3>Referencias</h3>

        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Parentesco</th>
                    <th>Tel</th>
                    <th>Tel2</th>
                    <th>Correo</th>
                    <th>Lugar de trabajo</th>
                </tr>
            </thead>

            <tbody>
            @foreach ($references as $r)

                
                <tr>
                                
                    <th>{{ $r->name }}</th>
                    <th>{{ $r->relationship_id }}</th>
                    <th>{{ $r->phone }}</th>
                    <th>{{ $r->phone2 }}</th>
                    <th>{{ $r->email }}</th>
                    <th>{{ $r->work_place }}</th>
                    
                </tr>
                

            @endforeach
            
            </tbody>
        </table>
    </body>
</html>