<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <tr>
        <th>Horarios de {{ $data['from'] . ' - ' . $data['to']}}</th>
    </tr>

    
            @foreach($data['data'] as $day) 

                @if(count($day['users']) > 0)

                <table>
                    <tr>
                        <th>DÍA {{$day['day']}}</th>
                    </tr>

                    @foreach($day['users'] as $user)
                        <tr><td>{{ $user['user_name'] }}</td></tr>
                    @endforeach

                </table>

                @endif

            @endforeach
            
    

</body>
</html>