@extends('layouts.admin')

@section('content')
<style>
.info-box {
    display: block;
    min-height: 120px;
    background: #fff;
    width: 100%;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    border-radius: 8px;
    margin-bottom: 15px;
    transition: all 0.3s ease;
    font-size: 14px;
}

.info-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.info-box .icon {
    display: block;
    float: left;
    height: 120px;
    width: 120px;
    text-align: center;
    font-size: 45px;
    line-height: 120px;
    color: rgba(255,255,255,0.8);
}

.info-box .content {
    padding: 15px 15px 15px 0;
    margin-left: 120px;
}

.info-box .number {
    font-size: 28px;
    font-weight: 700;
    margin: 5px 0;
}

.progress-info {
    margin-top: 10px;
}

.more-info {
    display: block;
    margin-top: 10px;
    color: rgba(255,255,255,0.8);
    font-size: 12px;
    text-transform: uppercase;
}

/* Gradientes de color */
.bg-gradient-primary {
    background: linear-gradient(135deg, #007bff 0%, #3d8bfd 100%) !important;
}

.bg-gradient-success {
    background: linear-gradient(135deg, #28a745 0%, #5cb85c 100%) !important;
}

.bg-gradient-warning {
    background: linear-gradient(135deg, #ffc107 0%, #f0ad4e 100%) !important;
}

.bg-gradient-secondary {
    background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%) !important;
}

.bg-gradient-danger {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%) !important;
}

.bg-gradient-info {
    background: linear-gradient(135deg, #17a2b8 0%, #138496 100%) !important;
}
</style>
    <div class="content" style="margin: 20px">
        {{-- <h1 style="text-align: center"><b>Panel de Administracion | FaceBol S.R.L</b></h1> --}}
        <h2 style="text-align: center" class="section-title"><i class="fas fa-chart-bar me-2"></i><b>Panel de Administración | FaceBol S.R.L.</b></h2>
        <br>
        <div class="row">
        <!-- Usuarios -->
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="info-box bg-gradient-primary hover-expand-effect">
                <div class="icon">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div class="content">
                    <div class="text">GESTIÓN DE USUARIOS</div>
                    <div class="number count-to" data-from="0" data-to="{{ $usuarios->count() }}" data-speed="1000">
                        {{ $usuarios->count() }}
                    </div>
                    <div class="progress-info">
                        <div class="progress">
                            <span class="progress-bar" style="width: {{ min(100, ($usuarios->count()/500)*100) }}%;">
                                <span class="sr-only">{{ min(100, ($usuarios->count()/500)*100) }}%</span>
                            </span>
                        </div>
                        <div class="status">
                            <div class="status-title">Crecimiento</div>
                            <div class="status-number">{{ min(100, ($usuarios->count()/500)*100) }}%</div>
                        </div>
                    </div>
                    <a href="{{ url('usuarios') }}" class="more-info">
                        Ver detalles <i class="bi bi-arrow-right-circle"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Informaciones -->
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="info-box bg-gradient-success hover-expand-effect">
                <div class="icon">
                    <i class="bi bi-building-check"></i>
                </div>
                <div class="content">
                    <div class="text">FORMULARIO DE DATOS</div>
                    <div class="number count-to" data-from="0" data-to="{{ $informacions->count() }}" data-speed="1000">
                        {{ $informacions->count() }}
                    </div>
                    <div class="progress-info">
                        <div class="progress">
                            <span class="progress-bar" style="width: {{ min(100, ($informacions->count()/500)*100) }}%;">
                                <span class="sr-only">{{ min(100, ($informacions->count()/500)*100) }}%</span>
                            </span>
                        </div>
                        <div class="status">
                            <div class="status-title">Crecimiento</div>
                            <div class="status-number">{{ min(100, ($informacions->count()/500)*100) }}%</div>
                        </div>
                    </div>
                    <a href="{{ url('informaciones') }}" class="more-info">
                        Ver detalles <i class="bi bi-arrow-right-circle"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Inscripciones -->
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="info-box bg-gradient-warning hover-expand-effect">
                <div class="icon">
                    <i class="bi bi-pc-display-horizontal"></i>
                </div>
                <div class="content">
                    <div class="text">REGISTRO ADMINISTRATIVO</div>
                    <div class="number count-to" data-from="0" data-to="{{ $inscripcions->count() }}" data-speed="1000">
                        {{ $inscripcions->count() }}
                    </div>
                    <div class="progress-info">
                        <div class="progress">
                            <span class="progress-bar" style="width: {{ min(100, ($inscripcions->count()/500)*100) }}%;">
                                <span class="sr-only">{{ min(100, ($inscripcions->count()/500)*100) }}%</span>
                            </span>
                        </div>
                        <div class="status">
                            <div class="status-title">Crecimiento</div>
                            <div class="status-number">{{ min(100, ($inscripcions->count()/500)*100) }}%</div>
                        </div>
                    </div>
                    <a href="{{ url('inscripciones') }}" class="more-info">
                        Ver detalles <i class="bi bi-arrow-right-circle"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Tarjetas RFID -->
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="info-box bg-gradient-secondary hover-expand-effect">
                <div class="icon">
                    <i class="bi bi-credit-card"></i>
                </div>
                <div class="content">
                    <div class="text">REGISTRO DE TARJETAS RFID</div>
                    <div class="number count-to" data-from="0" data-to="{{ $tarjetas->count() }}" data-speed="1000">
                        {{ $tarjetas->count() }}
                    </div>
                    <div class="progress-info">
                        <div class="progress">
                            <span class="progress-bar" style="width: {{ min(100, ($tarjetas->count()/500)*100) }}%;">
                                <span class="sr-only">{{ min(100, ($tarjetas->count()/500)*100) }}%</span>
                            </span>
                        </div>
                        <div class="status">
                            <div class="status-title">Crecimiento</div>
                            <div class="status-number">{{ min(100, ($tarjetas->count()/500)*100) }}%</div>
                        </div>
                    </div>
                    <a href="{{ url('tarjetas') }}" class="more-info">
                        Ver detalles <i class="bi bi-arrow-right-circle"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Asistencias -->
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="info-box bg-gradient-danger hover-expand-effect">
                <div class="icon">
                    <i class="bi bi-calendar-check"></i>
                </div>
                <div class="content">
                    <div class="text">ASISTENCIAS</div>
                    <div class="number count-to" data-from="0" data-to="{{ $asistencias->count() }}" data-speed="1000">
                        {{ $asistencias->count() }}
                    </div>
                    <div class="progress-info">
                        <div class="progress">
                            <span class="progress-bar" style="width: {{ min(100, ($asistencias->count()/500)*100) }}%;">
                                <span class="sr-only">{{ min(100, ($asistencias->count()/500)*100) }}%</span>
                            </span>
                        </div>
                        <div class="status">
                            <div class="status-title">Crecimiento</div>
                            <div class="status-number">{{ min(100, ($asistencias->count()/500)*100) }}%</div>
                        </div>
                    </div>
                    <a href="{{ url('asistencias') }}" class="more-info">
                        Ver detalles <i class="bi bi-arrow-right-circle"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Certificados -->
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="info-box bg-gradient-info hover-expand-effect">
                <div class="icon">
                    <i class="bi bi-file-earmark-text"></i>
                </div>
                <div class="content">
                    <div class="text">CERTIFICADOS</div>
                    <div class="number count-to" data-from="0" data-to="{{ $certificados->count() }}" data-speed="1000">
                        {{ $certificados->count() }}
                    </div>
                    <div class="progress-info">
                        <div class="progress">
                            <span class="progress-bar" style="width: {{ min(100, ($certificados->count()/500)*100) }}%;">
                                <span class="sr-only">{{ min(100, ($certificados->count()/500)*100) }}%</span>
                            </span>
                        </div>
                        <div class="status">
                            <div class="status-title">Crecimiento</div>
                            <div class="status-number">{{ min(100, ($certificados->count()/500)*100) }}%</div>
                        </div>
                    </div>
                    <a href="{{ url('certificados') }}" class="more-info">
                        Ver detalles <i class="bi bi-arrow-right-circle"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="content" style="margin: 20px">
        {{-- <h1 style="text-align: center"><b>Estadísticas Empresa FaceBol S.R.L.</b></h1> --}}
        
        <div class="row mt-4">
            <!-- Gráfico 3: Distribución por Año -->
            <div class="col-lg-12 mt-4">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            Distribución por Año de Estudio
                        </h3>
                    </div>
                    <div class="card-body">
                        <canvas id="aniosChart" style="min-height: 300px;"></canvas>
                    </div>
                </div>
            </div>
            <!-- Gráfico 1: Instituciones Universitarias -->
            <div class="col-lg-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-university mr-2"></i>
                            Top de Instituciones Universitarias
                        </h3>
                    </div>
                    <div class="card-body">
                        <canvas id="institucionesChart" style="min-height: 400px;"></canvas>
                    </div>
                </div>
            </div>

            <!-- Gráfico 2: Carreras más comunes -->
            <div class="col-lg-6">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-graduation-cap mr-2"></i>
                            Carreras más Demandadas en la empresa FaceBol S.R.L.
                        </h3>
                    </div>
                    <div class="card-body">
                        <canvas id="carrerasChart" style="min-height: 200px;"></canvas>
                    </div>
                </div>
            </div>
            <!-- Gráfico de Inscripciones por Mes -->
            <div class="col-lg-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-line mr-2"></i>
                            Registro Administrativo por Mes ({{ date('Y') }})
                        </h3>
                    </div>
                    <div class="card-body">
                        <canvas id="inscripcionesChart" style="min-height: 400px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

   @section('scripts')
@parent
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

    //JavaScript para la animación de conteo
    $(function() {
    $('.count-to').each(function() {
        var $this = $(this);
        $({ countNum: $this.attr('data-from') }).animate(
            { countNum: $this.attr('data-to') },
            {
                duration: parseInt($this.attr('data-speed')),
                easing: 'swing',
                step: function() {
                    $this.text(Math.floor(this.countNum));
                },
                complete: function() {
                    $this.text(this.countNum);
                }
            }
        );
    });
});

document.addEventListener('DOMContentLoaded', function() {
    // Verificar que los datos existen
    console.log('Datos para gráficos:', {
        instituciones: @json($instituciones),
        carreras: @json($carreras),
        anios: @json($anios)
    });

    // Gráfico de Inscripciones por Mes
const inscripcionesCtx = document.getElementById('inscripcionesChart');
if (inscripcionesCtx) {
    // Preparar datos para todos los meses
    const meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 
                  'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    
    // Obtener el mes actual (0-11)
    const mesActual = new Date().getMonth();
    
    // Crear array con todos los meses hasta el actual
    const mesesHastaActual = meses.slice(0, mesActual + 1);
    
    // Procesar datos recibidos del backend
    const datosInscripciones = @json($inscripcionesPorMes);
    
    // Crear un mapa de mes => total para fácil acceso
    const datosMap = new Map();
    datosInscripciones.forEach(item => {
        datosMap.set(parseInt(item.mes), item.total);
    });
    
    // Preparar datos para el gráfico (incluyendo meses sin datos)
    const datosGrafico = mesesHastaActual.map((nombreMes, index) => {
        const mesNumero = index + 1; // Los meses van de 1-12
        return datosMap.has(mesNumero) ? datosMap.get(mesNumero) : 0;
    });

    new Chart(inscripcionesCtx, {
        type: 'bar',
        data: {
            labels: mesesHastaActual,
            datasets: [{
                label: 'Inscripciones',
                data: datosGrafico,
                backgroundColor: 'rgba(96, 125, 139, 0.7)',
                borderColor: 'rgba(96, 125, 139, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.raw + ' inscripciones';
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        precision: 0
                    }
                }
            }
        }
    });
}

    // Gráfico de Instituciones
    // Gráfico de Instituciones
const institucionesCtx = document.getElementById('institucionesChart');
if (institucionesCtx) {
    // Verificar datos (solo para desarrollo)
    console.log('Instituciones:', @json($instituciones->pluck('insti_univer')));
    console.log('Totales:', @json($instituciones->pluck('total')));
    
    new Chart(institucionesCtx, {
        type: 'bar',
        data: {
            labels: @json($instituciones->pluck('insti_univer')),
            datasets: [{
                label: 'Estudiantes',
                data: @json($instituciones->pluck('total')),
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.raw + ' estudiantes';
                        }
                    }
                }
            },
            scales: {
                y: { 
                    beginAtZero: true,
                    ticks: {
                        precision: 0 // Mostrar números enteros
                    }
                },
                x: {
                    ticks: {
                        autoSkip: false,
                        maxRotation: 90,
                        minRotation: 90,
                        font: {
                            size: 10
                        }
                    }
                }
            }
        }
    });
} else {
    console.error('No se encontró el elemento institucionesChart');
}

    // Gráfico de Carreras
    const carrerasCtx = document.getElementById('carrerasChart');
    if (carrerasCtx) {
        new Chart(carrerasCtx, {
            type: 'doughnut',
            data: {
                labels: @json($carreras->pluck('carrera')),
                datasets: [{
                    data: @json($carreras->pluck('total')),
                    backgroundColor: [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0',
                        '#9966FF', '#FF9F40', '#8AC24A', '#607D8B'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'right' },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.raw + ' estudiantes';
                            }
                        }
                    }
                }
            }
        });
    } else {
        console.error('No se encontró el elemento carrerasChart');
    }

    // Gráfico de Años
    const aniosCtx = document.getElementById('aniosChart');
    if (aniosCtx) {
        new Chart(aniosCtx, {
            type: 'line',
            data: {
                labels: @json($anios->pluck('año')),
                datasets: [{
                    label: 'Estudiantes',
                    data: @json($anios->pluck('total')),
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.raw + ' estudiantes';
                            }
                        }
                    }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    } else {
        console.error('No se encontró el elemento aniosChart');
    }
});
</script>
@endsection
@endsection
