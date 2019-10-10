<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>    
    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
</head>
<body>

    <h3 class="w3-center">Productos</h3>
    <table class="w3-table w3-striped">
        <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Precio Interno</th>
            <th>Codigo</th>
        </tr>
        @foreach($products as $pro)        
        <tr>
            <td>{{ $pro->name}}</td>
            <td>${{ $pro->price_public}}</td>
            <td>${{ $pro->price_intern}}</td>
            @if($pro->code != NULL)
            <td>
                <img style="position: relative; margin-top: 5px" src="data:image/png;base64,{{DNS1D::getBarcodePNG($pro->code, 'C128')}}" alt="barcode" />
            </td>
            @else
                <td>
                    Sin codigo de barras
                </td>
            @endif
        </tr>
        @endforeach
    </table>
</body>
</html>