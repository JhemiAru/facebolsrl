<a class="btn btn-success" data-toggle="modal" data-target="#editModal{{$usuario->id}}" href="{{route('usuarios.edit', $usuario)}}">
    <i class="fa fa-pen"></i>
</a>

<div class="modal fade" id="editModal{{$usuario->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Restaurar Contraseña</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ url('/usuarios', $usuario->id.'0') }}">
                    @csrf
                    {{ method_field('PATCH') }}

                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre del Usuario</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{ $usuario->inscripciones->informacion->apellido_paterno }} {{ $usuario->inscripciones->informacion->apellido_materno }} {{ $usuario->inscripciones->informacion->nombre }}" autocomplete="name" autofocus readonly>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ $usuario->email }}" autocomplete="email" readonly>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3 d-flex justify-content-between">
                        <a href="{{ url('/usuarios') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-success">Restaurar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
