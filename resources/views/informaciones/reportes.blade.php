{{-- @extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 10px">
        <h1 class="text-center"><b>Bienvenido a la Administración de Reportes</b></h1>
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                Reporte de Informaciones
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box" style="height: 92px;">
                                    <span class="info-box-icon bg-info">
                                        <a href="{{ url('/informaciones/pdf') }}" target="_blank">
                                            <i class="bi bi-printer-fill"></i>
                                        </a>
                                    </span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Imprimir Reporte</span>
                                        <span class="info-box-number">Informaciónes</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="info-box">
                                    <span class="info-box-icon bg-warning">
                                        <a href="{{ url('/informaciones/pdf') }}">
                                            <i class="bi bi-printer-fill"></i>
                                        </a>
                                    </span>
                                    <div class="info-box-content">
                                        <form action="">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="">Fecha Inicio</label>
                                                    <input type="date" class="form-control">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Fecha Final</label>
                                                    <input type="date" class="form-control">
                                                </div>
                                                <div class="col-md-4">
                                                    <div style="height: 37px;"></div>
                                                    <button type="submit" class="btn btn-success">Generar Reporte</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
 --}}