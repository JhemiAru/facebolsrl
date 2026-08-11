@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Configurar la hora automatizar</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('cron_schedule.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="hora_ejecucion">Hora de ejecución:</label>
            <input type="time" id="hora_ejecucion" name="hora_ejecucion" class="form-control"
                   value="{{ $cronSchedule->hora_ejecucion ?? '09:05' }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection
