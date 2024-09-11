@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 10px">
        <h1 class="text-center"><b>Bienvenido a la Administración de Reportes</b></h1>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-body" style="...">

                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-info">
                                    <a href="{{ url('/informaciones/pdf') }}">
                                        <i class="bi bi-printer-fill"></i>
                                    </a>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Imprimir Reporte</span>
                                    <span class="info-box-number">Informaciónes</span>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection
