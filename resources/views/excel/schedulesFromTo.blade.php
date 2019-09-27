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

    
           

                <table>
                    <tr>
                        @foreach($data['data'] as $day)                             
                            <th>{{$day['day_name']}}</th>                            
                        @endforeach
                    </tr>                    

                    @foreach($data['names'] as $users) 
                    <tr>                                                    
                        @foreach($users as $user)
                            @if($user != NULL)
                                <td>{{ $user }}</td>
                            @else
                                <td>hola</td>
                            @endif
                        @endforeach
                    </tr>
                    @endforeach
                </table>   
                
                {{-- <tr>{{$data['names']}} --}}
                

</body>
</html>