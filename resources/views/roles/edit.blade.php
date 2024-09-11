{{-- @extends('layouts.admin')

@section('content')
<div class="content" style="margin-left: 10px">
    <h1 class="text-center"><b>Editar Rol</b></h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"><b>Editar Rol: {{ $role->name }}</b></h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('roles.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Nombre del Rol</label>
                            <input type="text" name="name" class="form-control" value="{{ $role->name }}" required>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Estado</th>
                                    <th>Nombre</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($permissions as $id => $permission)
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $id }}" {{ in_array($id, $rolePermissions) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td>{{ $permission }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" onclick="window.history.back();">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Actualizar Rol</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 --}}