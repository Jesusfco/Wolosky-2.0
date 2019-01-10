<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    @foreach($data as $day) 
    <tr><h2>Día #{{ $day['day']}}</h2></tr>

        @foreach($day['schedules'] as $schedule) 
        <tr>
            <h3 class="centerText">Horario: {{ $schedule['check_in'] }} - {{ $schedule['check_in'] + 1 }}</h3> 
        </tr>       <?php sort($schedule['users']) ?>
        @foreach($schedule['users'] as $user) 
            <tr><td>{{ $user['user_name'] }}</td></tr>
            @endforeach

        @endforeach

    @endforeach

</body>
</html>