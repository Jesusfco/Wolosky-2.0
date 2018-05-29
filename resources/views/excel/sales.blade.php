<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Vendedor</th>
        <th>Total</th>     
        <th>Tipo</th>        
        <th>Fecha/Hora</th>
    </tr>
    </thead>
    <tbody>
    @foreach($sales as $sale)
        <tr>
            <td>{{ $sale->id }}</td>
            <td>{{ $sale->user_name }}</td>
            <td>{{ $sale->total }}</td>
            <th>{{ $sale->type_name}}</th> 
            <td>{{ $sale->created_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table