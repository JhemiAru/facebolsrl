@php
    use Illuminate\Support\Facades\Session;
@endphp

@extends('layouts.admin')

@section('content')
    <div class="contect" style="margin-left: 20px">
        <h1 class="text-center"><b>Bienvenido a la Administración de Reportes Actividades</b></h1><br>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">

                        <h3 class="card-title"><b>Reportes de Actividad Registrados</b></h3>
                        <!-- Tabla secundaria (solo nombres y códigos) -->
                        {{--                 <table class="table table-sm table-bordered mt-2">
                        <thead>
                            <tr>
                                <th>Pasante</th>
                                <th>Código Credencial</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reporteactividades->unique('asistencia.inscripciones.informacion.id') as $reporte)
                                <tr>
                                    <td>{{ $reporte->asistencia->inscripciones->informacion->nombre }}</td>
                                    <td>{{ $reporte->asistencia->inscripciones->codigo_credencial }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table> --}}

                    </div>
                    <div class="card-body" style="display: block;">
                        <table id="example1" class="table table-bordered table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>Nro</th>
                                    <th>Nombre Pasante</th>
                                    <th>Mes Literal</th>
                                    <th>Semana</th>
                                    <th>Fecha Lunes</th>
                                    <th>Actividad Lunes</th>
                                    <th>Fecha Martes</th>
                                    <th>Actividad Martes</th>
                                    <th>Fecha Miercoles</th>
                                    <th>Actividad Miercoles</th>
                                    <th>Fecha Jueves</th>
                                    <th>Actividad Jueves</th>
                                    <th>Fecha Viernes</th>
                                    <th>Actividad Viernes</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $contador = 0; ?>
                                @foreach ($reporteactividades as $reporteactividad)
                                    <tr>
                                        <td><?php echo $contador = $contador + 1; ?></td>
                                        <td>{{ $reporteactividad->asistencia->inscripciones->informacion->nombre }}</td>
                                        <td>
                                            <span class="badge bg-secondary">
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">
                                                        {{ $reporteactividad->mesLiteral }}</font>
                                                </font>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-success">
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">{{ $reporteactividad->semana }}
                                                    </font>
                                                </font>
                                            </span>
                                        </td>
                                        <td>{{ $reporteactividad->f1 }}</td>
                                        <td>{{ $reporteactividad->actividade1 }}</td>
                                        <td>{{ $reporteactividad->f2 }}</td>
                                        <td>{{ $reporteactividad->actividade2 }}</td>
                                        <td>{{ $reporteactividad->f3 }}</td>
                                        <td>{{ $reporteactividad->actividade3 }}</td>
                                        <td>{{ $reporteactividad->f4 }}</td>
                                        <td>{{ $reporteactividad->actividade4 }}</td>
                                        <td>{{ $reporteactividad->f5 }}</td>
                                        <td>{{ $reporteactividad->actividade5 }}</td>
                                        <td>
                                            <div class="d-flex flex-row gap-2" role="group" aria-label="Basic example">
                                                @can('editarActividad')
                                                    <a href="{{ route('editarActividad', $reporteactividad->id) }}"
                                                        class="btn btn-success w-sm">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                @endcan
                                                @can('eliminarActividad')
                                                    <form action="{{ route('eliminarActividad', $reporteactividad->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            onclick=" return confirm('Estas seguro de eliminar este registro?')"
                                                            class="btn btn-danger" value="">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                @endcan
                                                <a href="{{ route('reporteactividad.pdf', $reporteactividad->id) }}"
                                                    target="_blank" class="btn btn-danger" title="Generar PDF">
                                                    <i class="bi bi-file-pdf"></i>
                                                </a>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#enviarModal" data-id="{{ $reporteactividad->id }}">
                                                    <i class="bi bi-send"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <script>
                            $(function() {
                                $("#example1").DataTable({
                                    "pageLength": 10,
                                    "language": {
                                        "emptyTable": "No hay información",
                                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Reportes",
                                        "infoEmpty": "Mostrando 0 a 0 de 0 Reportes",
                                        "infoFiltered": "(Filtrado de _MAX_ total Reportes)",
                                        "infoPostFix": "",
                                        "thousands": ",",
                                        "lengthMenu": "Mostrar _MENU_ Reportes",
                                        "loadingRecords": "Cargando...",
                                        "processing": "Procesando...",
                                        "search": "Buscador:",
                                        "zeroRecords": "Sin resultados encontrados",
                                        "paginate": {
                                            "first": "Primero",
                                            "last": "Ultimo",
                                            "next": "Siguiente",
                                            "previous": "Anterior"
                                        }
                                    },
                                    "responsive": true,
                                    "lengthChange": true,
                                    "autoWidth": false,
                                    "searching": true, // Habilitar búsqueda en todos los campos
                                    buttons: [{
                                            extend: 'collection',
                                            text: 'Reportes',
                                            orientation: 'landscape',
                                            buttons: [{
                                                text: 'Copiar',
                                                extend: 'copy',
                                            }, {
                                                extend: 'pdf'
                                            }, {
                                                extend: 'csv'
                                            }, {
                                                extend: 'excel'
                                            }, {
                                                text: 'Imprimir',
                                                extend: 'print'
                                            }]
                                        },
                                        {
                                            extend: 'colvis',
                                            text: 'Visor de columnas',
                                            collectionLayout: 'fixed three-column'
                                        }
                                    ],
                                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                            });
                        </script>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalAlerta" tabindex="-1" aria-labelledby="modalAlertaLabel" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-body text-center p-4">
                    <div class="mb-3">
                        <i id="alertaIcono" class="bi" style="font-size: 4rem;"></i>
                    </div>
                    <h4 id="alertaTitulo" class="mb-3"></h4>
                    <p id="alertaMensaje" class="mb-0"></p>
                    <div id="alertaListaErrores" class="text-start mt-3" style="display: none;">
                        <ul id="listaErrores" class="mb-0"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="enviarModal" tabindex="-1" aria-labelledby="enviarModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="enviarModalLabel">Enviar Reporte de Actividad por Correo</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="reporte_id" id="reporte_id">
                    <div class="form-group">
                        <label for="email_remitente">De (Email Remitente): <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email_remitente" name="email_remitente"
                            placeholder="correo@facebolsrl.net" required>
                    </div>

                    <div class="form-group">
                        <label for="email_destinatario">Para (Email Destinatario): <span
                                class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email_destinatario" name="email_destinatario"
                            value="talentohumano.admin@facebolsrl.net" readonly required>
                        {{-- <input type="email" class="form-control" id="email_destinatario" name="email_destinatario"
                            value="chrystianralfc@gmail.com" readonly required> --}}
                    </div>

                    <div class="form-group">
                        <label for="asunto">Asunto: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="asunto" name="asunto"
                            placeholder="Reporte Semanal de Actividades - Semana X" required>
                    </div>

                    <div class="form-group">
                        <label for="contenido">Contenido del Mensaje: (Adjuntar nombre del personal de trabajo)<span
                                class="text-danger">*</span></label>
                        <textarea class="form-control" id="contenido" name="contenido" rows="5"
                            placeholder="Escribe el mensaje que acompañará el reporte..." required></textarea>
                    </div>

                    <!-- Indicador de carga -->
                    <div id="loading_envio" class="text-center" style="display: none;">
                        <div class="spinner-border text-success" role="status">
                            <span class="visually-hidden">Enviando...</span>
                        </div>
                        <p class="mt-2 text-muted">Enviando correo electrónico...</p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle"></i> Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary" id="btnFormEnviarInforme">
                            <i class="bi bi-send"></i> Enviar Reporte
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let enviarModal = document.getElementById('enviarModal');
            let reporteId = null;

            enviarModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                reporteId = button.getAttribute('data-id');

                document.getElementById('email_remitente').value = '';
                document.getElementById('email_destinatario').value = 'talentohumano.admin@facebolsrl.net';
                document.getElementById('asunto').value = '';
                document.getElementById('contenido').value = '';

                // Ocultar indicador de carga
                document.getElementById('loading_envio').style.display = 'none';

                // Habilitar botón de envío
                document.getElementById('btnFormEnviarInforme').disabled = false;
            });

            window.mostrarAlerta = function(tipo, titulo, mensaje, listaErrores = null) {
                const modal = new bootstrap.Modal(document.getElementById('modalAlerta'));
                const icono = document.getElementById('alertaIcono');
                const tituloElement = document.getElementById('alertaTitulo');
                const mensajeElement = document.getElementById('alertaMensaje');
                const listaErroresDiv = document.getElementById('alertaListaErrores');
                const listaErroresUl = document.getElementById('listaErrores');

                // Resetear clases
                icono.className = 'bi';
                tituloElement.className = 'mb-3';

                // Configurar según el tipo
                if (tipo === 'success') {
                    icono.classList.add('bi-check-circle-fill', 'text-success');
                    tituloElement.classList.add('text-success');
                } else if (tipo === 'error') {
                    icono.classList.add('bi-x-circle-fill', 'text-danger');
                    tituloElement.classList.add('text-danger');
                } else if (tipo === 'warning') {
                    icono.classList.add('bi-exclamation-triangle-fill', 'text-warning');
                    tituloElement.classList.add('text-warning');
                }

                // Establecer contenido
                tituloElement.textContent = titulo;
                mensajeElement.textContent = mensaje;

                // Manejar lista de errores
                if (listaErrores && listaErrores.length > 0) {
                    listaErroresUl.innerHTML = '';
                    listaErrores.forEach(error => {
                        const li = document.createElement('li');
                        li.textContent = error;
                        listaErroresUl.appendChild(li);
                    });
                    listaErroresDiv.style.display = 'block';
                } else {
                    listaErroresDiv.style.display = 'none';
                }

                // Mostrar modal
                modal.show();

                // Auto-cerrar después de 2 segundos
                setTimeout(function() {
                    modal.hide();
                }, 2000);
            }

            document.getElementById('btnFormEnviarInforme').addEventListener('click', function(event) {
                const emailRemitente = document.getElementById('email_remitente').value.trim();
                const emailDestinatario = document.getElementById('email_destinatario').value.trim();
                const asunto = document.getElementById('asunto').value.trim();
                const contenido = document.getElementById('contenido').value.trim();

                if (!emailRemitente || !emailDestinatario || !asunto || !contenido) {
                    mostrarAlerta('warning', 'Atención',
                        'Por favor, completa todos los campos requeridos.');
                    return;
                }

                document.getElementById('loading_envio').style.display = 'block';
                document.getElementById('btnFormEnviarInforme').disabled = true;

                const url = `{{ url('/enviar-informe') }}/` + reporteId;
                const bodyData = {
                    remitente: emailRemitente,
                    destinatario: emailDestinatario,
                    asunto: asunto,
                    contenido: contenido
                };

                fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(bodyData)
                    })
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('loading_envio').style.display = 'none';
                        document.getElementById('btnFormEnviarInforme').disabled = false;

                        document.getElementById('email_remitente').value = '';
                        document.getElementById('email_destinatario').value = '';
                        document.getElementById('asunto').value = '';
                        document.getElementById('contenido').value = '';
                        reporteId = null;

                        setTimeout(() => {
                            var modal = bootstrap.Modal.getInstance(enviarModal);
                            modal.hide();

                            setTimeout(() => {
                                if (data.success) {
                                    mostrarAlerta('success', '¡Éxito!',
                                        '✅ El correo se envió correctamente a: ' +
                                        emailDestinatario);
                                } else {
                                    mostrarAlerta('error', '¡Error!', '❌ ' + (data
                                        .message ||
                                        'No se pudo enviar el correo. Por favor, intenta nuevamente.'
                                    ));
                                }
                            }, 300);
                        }, 2000);
                    })
                    .catch(error => {
                        document.getElementById('loading_envio').style.display = 'none';
                        document.getElementById('btnFormEnviarInforme').disabled = false;

                        var modal = bootstrap.Modal.getInstance(enviarModal);
                        modal.hide();

                        setTimeout(() => {
                            mostrarAlerta('error', '¡Error!',
                                '❌ No se pudo enviar el correo. Por favor, verifica tu conexión e intenta nuevamente.'
                            );
                        }, 300);
                        console.error('Error:', error);
                    });
            });
        });
    </script>
@endsection
