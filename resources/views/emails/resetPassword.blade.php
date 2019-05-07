<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
    <img src="{{ url('images/Wolosky-Logo.png') }}" width="50px">    
    <p>Hola, {{ $data['user']->name}} :</p>
    <p>   	         
        Recibimos una solicitud para restablecer tu contraseña de Wolosky.<br>
        Ingresa el siguiente código para restablecer la contraseña:         
    </p>

    
        <h3>Código</h3>
        <h2><strong>{{ $data['token']->token }}</strong></h2>
        {{-- También puedes cambiar la contraseña directamente.  --}}
         
        
        {{-- Cambiar contraseña --}}
        
        
                
         
        <p>
        <strong>¿No solicitaste este cambio?</strong><br>
            Si no solicitaste una nueva contraseña, avísanos.
        </p>

    </body>
</html>