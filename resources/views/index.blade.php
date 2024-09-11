@extends('layouts.admin')

@section('content')
    <div class="content" style="margin: 20px">
        <h1 style="text-align: center"><b>Pagina principal</b></h1>
        <br>
        

        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning" style="height: 160px;">
                    <div class="inner">
                        <?php $contador_de_usuarios = 0; ?>
                        @foreach ($usuarios as $usuario)
                            <?php $contador_de_usuarios = $contador_de_usuarios + 1; ?>
                        @endforeach
                        <h3><?= $contador_de_usuarios ?></h3>
                        <p>Usuarios</p>
                    </div>
                    <div class="icon">
                        <i class="bi bi-person-check"></i>
                    </div>
                    <a href="{{ url('usuarios') }}" class="small-box-footer" style="margin-top: 15px">Mas informacion <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info" style="height: 160px;">
                        <div class="inner">
                            <?php $contador_de_informacions = 0; ?>
                            @foreach ($informacions as $informacion)
                                <?php $contador_de_informacions = $contador_de_informacions + 1; ?>
                            @endforeach
                            <h3><?= $contador_de_informacions ?></h3>
                            <p>Informaciones</p>
                        </div>
                        <div class="icon">
                            <i class="bi bi-building-check"></i>
                        </div>
                        <a href="{{ url('informaciones') }}" class="small-box-footer" style="margin-top: 15px">Mas informacion
                            <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success" style="height: 160px;">
                        <div class="inner">
                            <?php $contador_de_inscripcions = 0; ?>
                            @foreach ($inscripcions as $inscripcion)
                                <?php $contador_de_inscripcions = $contador_de_inscripcions + 1; ?>
                            @endforeach
                            <h3><?= $contador_de_inscripcions ?></h3>
                            <p>Inscripciones</p>
                        </div>
                        <div class="icon">
                            <i class="bi bi-pc-display-horizontal"></i>
                        </div>
                        <a href="{{ url('inscripciones') }}" class="small-box-footer" style="margin-top: 15px">Mas informacion <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info" style="height: 160px;">
                        <div class="inner">
                            <?php $contador_de_areas = 0; ?>
                            @foreach ($areas as $area)
                                <?php $contador_de_areas = $contador_de_areas + 1; ?>
                            @endforeach
                            <h3><?= $contador_de_areas ?></h3>
                            <p>Áreas</p>
                        </div>
                        <div class="icon">
                            <i class="bi bi-person-lines-fill"></i>
                        </div>
                        <a href="{{ url('areas') }}" class="small-box-footer" style="margin-top: 15px">Mas informacion <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success" style="height: 160px;">
                        <div class="inner">
                            <?php $contador_de_generacions = 0; ?>
                            @foreach ($generacions as $generacion)
                                <?php $contador_de_generacions = $contador_de_generacions + 1; ?>
                            @endforeach
                            <h3><?= $contador_de_generacions ?></h3>
                            <p>Generaciones</p>
                        </div>
                        <div class="icon">
                            <i class="bi bi-file-person-fill"></i>
                        </div>
                        <a href="{{ url('generaciones') }}" class="small-box-footer" style="margin-top: 15px">Mas informacion <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
