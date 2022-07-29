@if($type == "user")

Su registro ha sido exitoso

@else

Se ha generado un nuevo registro
<br>
<br>
<b>Listado</b>
<br>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>País</th>
            <th>Usuarios</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $d)
        <tr>
            <td>{{ $d['code'] }}</td>
            <td>{{ $d['country'] }}</td>
            <td>{{ $d['total_user'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endif