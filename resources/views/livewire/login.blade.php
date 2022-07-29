<div>
    <h4 class="card-title text-center">Listado</h4>
    <div class="col-md-12 d-flex justify-content-center">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre y Apellido</th>
                        <th>Cédula</th>
                        <th>Telefono</th>
                        <th>Correo</th>
                        <th>Categoria</th>
                        <th>País</th>
                        <th>Dirección</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $user)
                    <tr>
                        <td scope="row">{{ $user->id }}</td>
                        <td>{{ $user->name . " " .$user->lstname }}</td>
                        <td>{{ $user->document_number }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->getCategorie->name }}</td>
                        <td>{{ $user->country }}</td>
                        <td>{{ $user->street }}</td>
                        <td>
                            <button type="button"  wire:click="delete({{ $user->id }})" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            <a href="{{ env('APP_URL', 'http://localhost') }}/edit/{{ $user->id }}" type="button" class="btn btn-warning btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
