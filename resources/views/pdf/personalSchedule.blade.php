<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Usuario: {{ $user->name }}</title>
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



            
    </body>
</html>