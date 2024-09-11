<!-- resources/views/roles/show.blade.php -->

@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 10px">
        <h1 class="text-center"><b>Detalles del Permiso</b></h1>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><b>Permiso: {{ $permiso->name }}</b></h3>
                <div class="card-tools">
                    <a href="{{ route('permisos.index') }}" class="btn btn-primary">
                        <i class="bi bi-arrow-left"></i> Volver
                    </a>
                </div>
            </div>
            <div class="card-body">
                {{-- <p><strong>ID:</strong> {{ $role->id }}</p> --}}
                <p><strong>Nombre:</strong> {{ $permiso->name }}</p>
                <p><strong>Guard Name:</strong> {{ $permiso->guard_name }}</p>
                <p><strong>Creado en:</strong> {{ $permiso->created_at }}</p>
                <p><strong>Actualizado en:</strong> {{ $permiso->updated_at }}</p>
            </div>
        </div>
    </div>
@endsection
