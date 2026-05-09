<?php $__env->startSection('title', 'Horario'); ?>
<?php $__env->startSection('plugins.Sweetalert2', true); ?>
<?php $__env->startSection('content_header'); ?>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><i
                                    class="nav-icon fas fa-th mr-2"></i>Escritorio</a></li>
                        <li class="breadcrumb-item active"><i class="fas fa-fw fa-share mr-2"></i>Horario</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card card-dark">
                    <div class="card-header">
                        <h4 class="card-title">Crear Horarios</h4>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="<?php echo e(route('horario.store')); ?>" id="horario-form">
                            <?php echo csrf_field(); ?>

                            <div class="form-group">
                                <label for="profesor_id">Profesor:</label>
                                <?php echo e(Form::select('profesor_id', $profesorProfesor, $profesor->profesor_id,
                                        ['class' => 'form-control' . ($errors->has('profesor_id') ? ' is-invalid' : ''),
                                        'id' => 'profesor_id', 'style' => 'width: 100%',
                                        'placeholder' => 'Elegir Profesor'])); ?>

                            </div>

                            <div class="form-group">
                                <label for="nivel_educativo">Nivel Educativo:</label>
                                <select name="nivel_educativo" id="nivel_educativo" class="form-control" required>
                                    <option value="">Seleccionar Nivel Educativo</option>
                                    <option value="Inicial">Inicial</option>
                                    <option value="Primaria">Primaria</option>
                                    <option value="Secundaria">Secundaria</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="turno">Turno:</label>
                                <select name="turno" id="turno" class="form-control" required>
                                    <option value="">Seleccionar turno</option>
                                    <option value="mañana">Mañana</option>
                                    <option value="tarde">Tarde</option>
                                    <option value="ambos">Ambos</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <button type="button" class="btn btn-primary" id="btnMostrarHorario" data-toggle="modal" data-target="#horario.modal.horario">Mostrar Horario</button>
                            </div>

                            <!-- Horario de mañana -->
                            <div class="horario" id="horario-mañana" style="display: none;">
                                <h4>Horario de Mañana</h4>
                                <div class="table-responsive">
                                    <table class="table align-item-center table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">Dia</th>
                                                <th scope="col">Activo</th>
                                                <th scope="col">Hora de inicio</th>
                                                <th scope="col">Hora de fin</th>
                                            </tr>
                                        </thead>
                                        <tbody id="horario-mañana-body">
                                            <?php $__currentLoopData = $dias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $dia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $horario = $profesor->horarios->firstWhere('dia', $dia);
                                                    $activo = $horario ? 'checked' : '';
                                                    $unique_id = 'manana' . $index; // Agregar un identificador único para los horarios de mañana
                                                ?>
                                                <tr>
                                                    <th><?php echo e($dia); ?></th>
                                                    <td>
                                                        <label class="custom-toggle">
                                                            <input type="checkbox" name="horarios_mañana[<?php echo e($unique_id); ?>][activo]" value="1" <?php echo e($activo); ?>>
                                                            <span class="custom-toggle-slider rounded-circle"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col">
                                                                <input type="time" class="form-control" name="horarios_mañana[<?php echo e($unique_id); ?>][hora_inicio]" value="<?php echo e($horario ? $horario->hora_inicio : ''); ?>">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col">
                                                                <input type="time" class="form-control" name="horarios_mañana[<?php echo e($unique_id); ?>][hora_fin]" value="<?php echo e($horario ? $horario->hora_fin : ''); ?>">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <input type="hidden" name="horarios_mañana[<?php echo e($unique_id); ?>][dia]" value="<?php echo e($dia); ?>">
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Horario de tarde -->
                            <div class="horario" id="horario-tarde" style="display: none;">
                                <h4>Horario de Tarde</h4>
                                <div class="table-responsive">
                                    <table class="table align-item-center table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">Dia</th>
                                                <th scope="col">Activo</th>
                                                <th scope="col">Hora de inicio</th>
                                                <th scope="col">Hora de fin</th>
                                            </tr>
                                        </thead>
                                        <tbody id="horario-tarde-body">
                                            <?php $__currentLoopData = $dias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $dia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $horario = $profesor->horarios->firstWhere('dia', $dia);
                                                    $activo = $horario ? 'checked' : '';
                                                    $unique_id = 'tarde' . $index; // Agregar un identificador único para los horarios de tarde
                                                ?>
                                                <tr>
                                                    <th><?php echo e($dia); ?></th>
                                                    <td>
                                                        <label class="custom-toggle">
                                                            <input type="checkbox" name="horarios_tarde[<?php echo e($unique_id); ?>][activo]" value="1" <?php echo e($activo); ?>>
                                                            <span class="custom-toggle-slider rounded-circle"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col">
                                                                <input type="time" class="form-control" name="horarios_tarde[<?php echo e($unique_id); ?>][hora_inicio]" value="<?php echo e($horario ? $horario->hora_inicio : ''); ?>">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col">
                                                                <input type="time" class="form-control" name="horarios_tarde[<?php echo e($unique_id); ?>][hora_fin]" value="<?php echo e($horario ? $horario->hora_fin : ''); ?>">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <input type="hidden" name="horarios_tarde[<?php echo e($unique_id); ?>][dia]" value="<?php echo e($dia); ?>">
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-success">Registrar Horario</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card card-dark">
                    <div class="card-header">
                        <h4 class="card-title">Listado de Horarios</h4>

                        <div class="card-tools">
                            <!-- This will cause the card to maximize when clicked -->
                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                    class="fas fa-expand"></i></button>
                            <!-- This will cause the card to collapse when clicked -->
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                            <!-- This will cause the card to be removed when clicked -->
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="btn-toolbar" role="toolbar">
                            <div class="btn-group mr-2" role="group" aria-label="Generar PDF">
                                <form action="<?php echo e(route('generar.pdf')); ?>" method="GET" target="_blank">
                                    <input type="hidden" name="tipo" value="horarios"> <!-- Agrega el parámetro tipo=horarios -->
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-success"><i class="fas fa-file-pdf"></i> Generar PDF</button>
                                </form>
                            </div>

                            <div class="btn-group" role="group" aria-label="Generar Excel">
                                <button onclick="generarExcel()" class="btn btn-success"><i class="fas fa-file-excel"></i> Generar Excel</button>
                            </div>
                        </div>

                        <hr>
                        <table id="tbmantenimiento"
                            class="table table-sm table-striped table-hover table-bordered shadow-lg  dt-responsive nowrap"
                            style="width:100%">
                            <thead class="text-white" style="background-color:#6777ef">
                                <tr>
                                    <th>Profesor</th>
                                    <th>Horario</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $profesores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profesor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($profesor->nombres); ?> <?php echo e($profesor->apellidos); ?></td>
                                        <td colspan="3">
                                            <button class="btn btn-sm btn-primary toggle-btn" data-target="<?php echo e($profesor->id); ?>">Mostrar Horarios</button>
                                            <div class="schedule-table" id="schedule-<?php echo e($profesor->id); ?>">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Día</th>
                                                            <th>Turno</th>
                                                            <th>Nivel</th>
                                                            <th>Hora de inicio</th>
                                                            <th>Hora de fin</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $__currentLoopData = $profesor->horarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $horario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr>
                                                                <td><?php echo e($horario->dia_semana); ?></td>
                                                                <td><?php echo e($horario->turno); ?></td>
                                                                <td><?php echo e($horario->nivel_educativo); ?></td>
                                                                <td><?php echo e(\Carbon\Carbon::parse($horario->hora_inicio)->format('h:i A')); ?></td>
                                                                <td><?php echo e(\Carbon\Carbon::parse($horario->hora_fin)->format('h:i A')); ?></td>

                                                                <td>
                                                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                                                        data-target="#editar<?php echo e($horario->id); ?>">
                                                                        <i class="fas fa-edit"></i>
                                                                    </button>
                                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                                        data-target="#eliminar<?php echo e($horario->id); ?>">
                                                                        <i class="far fa-trash-alt icon-size"></i>
                                                                    </button>
                                                                </td>
                                                                <!--Ventana Modal para la Alerta de mostrar--->
                                                                <?php echo $__env->make('horario.modal.editar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                                <?php echo $__env->make('horario.modal.eliminar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                            </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>




<?php $__env->startSection('css'); ?>
    <!-- estilos para tablas profesionales datatable-->
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.bootstrap5.min.css">

    <!-- estilos para botones de exportación-->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"></script>

    <!-- scripts para exportación de archivos-->
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.2/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>


    <script>
        $(document).ready(function() {
            // Función para habilitar o deshabilitar los campos de hora de inicio y fin según el estado del checkbox
            function toggleHorario(id) {
                var checkbox = $('input[name="horarios_tarde[' + id + '][activo]"]');
                var horaInicioInput = $('input[name="horarios_tarde[' + id + '][hora_inicio]"]');
                var horaFinInput = $('input[name="horarios_tarde[' + id + '][hora_fin]"]');

                // Habilitar o deshabilitar los campos de hora de inicio y fin según el estado del checkbox
                horaInicioInput.prop('disabled', !checkbox.prop('checked'));
                horaFinInput.prop('disabled', !checkbox.prop('checked'));

                // Limpiar los valores de hora de inicio y fin si el checkbox no está marcado
                if (!checkbox.prop('checked')) {
                    horaInicioInput.val('');
                    horaFinInput.val('');
                }
            }

            // Asignar la función toggleHorario a cada checkbox al cargar la página
            $('input[type="checkbox"]').each(function() {
                var id = $(this).attr('name').match(/\[(.*?)\]/)[1];
                $(this).change(function() {
                    toggleHorario(id);
                });
                toggleHorario(id); // Llamar a toggleHorario al cargar la página para establecer el estado inicial
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Función para habilitar o deshabilitar los campos de hora de inicio y fin según el estado del checkbox
            function toggleHorario(id) {
                var checkbox = $('input[name="horarios_mañana[' + id + '][activo]"]');
                var horaInicioInput = $('input[name="horarios_mañana[' + id + '][hora_inicio]"]');
                var horaFinInput = $('input[name="horarios_mañana[' + id + '][hora_fin]"]');

                // Habilitar o deshabilitar los campos de hora de inicio y fin según el estado del checkbox
                horaInicioInput.prop('disabled', !checkbox.prop('checked'));
                horaFinInput.prop('disabled', !checkbox.prop('checked'));

                // Limpiar los valores de hora de inicio y fin si el checkbox no está marcado
                if (!checkbox.prop('checked')) {
                    horaInicioInput.val('');
                    horaFinInput.val('');
                }
            }

            // Asignar la función toggleHorario a cada checkbox al cargar la página
            $('input[type="checkbox"]').each(function() {
                var id = $(this).attr('name').match(/\[(.*?)\]/)[1];
                $(this).change(function() {
                    toggleHorario(id);
                });
                toggleHorario(id); // Llamar a toggleHorario al cargar la página para establecer el estado inicial
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Función para mostrar el horario según el turno seleccionado
            function mostrarHorario() {
                const turnoSeleccionado = $('#turno').val();

                if (turnoSeleccionado === 'mañana') {
                    $('#horario-mañana').show();
                    $('#horario-tarde').hide();
                } else if (turnoSeleccionado === 'tarde') {
                    $('#horario-mañana').hide();
                    $('#horario-tarde').show();
                } else if (turnoSeleccionado === 'ambos') {
                    $('#horario-mañana').show();
                    $('#horario-tarde').show();
                } else {
                    // Si no se selecciona un turno válido, ocultar ambos horarios
                    $('#horario-mañana').hide();
                    $('#horario-tarde').hide();
                }

            }

            // Asociar la función mostrarHorario al evento click del botón
            $('#btnMostrarHorario').click(mostrarHorario);
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#tbmantenimiento').DataTable({

                //traduccion datatable
                "order": [[0, "desc"]],
                "language": {
                    "lengthMenu": "Mostrar " +
                        '<select class="custom-select custom-select-sm form-control form-control-sm"> <option value="5">5</option><option value="10">10</option><option value="15">15</option><option value="20">20</option><option value="25">25</option><option value="-1">All</option></select>' +
                        " registros por página",
                    "zeroRecords": "Nada encontrado - disculpa",
                    "info": "Mostrando la página PAGE de PAGES",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrado de MAX registros totales)",
                    "search": "Buscar :",
                    "paginate": {
                        "next": "siguiente",
                        "previous": "Anterior"
                    }
                },

                //paginacion
                "lengthMenu": [
                    [5, 10, 50, -1],
                    [5, 10, 50, "All"]
                ]

            });

        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButtons = document.querySelectorAll('.toggle-btn');

            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-target');
                    const scheduleTable = document.getElementById(`schedule-${targetId}`);

                    if (scheduleTable.style.display === 'none' || scheduleTable.style.display === '') {
                        scheduleTable.style.display = 'block';
                        this.textContent = 'Ocultar Horarios';
                    } else {
                        scheduleTable.style.display = 'none';
                        this.textContent = 'Mostrar Horarios';
                    }
                });

                // Ocultar los horarios al cargar la página
                const targetId = button.getAttribute('data-target');
                const scheduleTable = document.getElementById(`schedule-${targetId}`);
                scheduleTable.style.display = 'none';
            });
        });


    </script>
    <script>
        // Función para generar el archivo Excel
        function generarExcel() {
            // Datos de la tabla
            var tabla = document.getElementById('tbmantenimiento');
            var datos = [];

            // Iterar sobre las filas de la tabla para obtener los datos
            for (var i = 1; i < tabla.rows.length; i++) {
                var fila = tabla.rows[i];
                var profesor = fila.cells[0].innerText;
                var horario = fila.cells[1].innerText;

                // Obtener la tabla de horarios para el profesor actual
                var tablaHorarios = fila.querySelector('.schedule-table table');

                // Agregar el nombre del profesor como una fila separada
                datos.push([profesor]);

                // Agregar la fila de encabezados de horarios
                datos.push(['Día', 'Turno', 'Nivel', 'Hora de inicio', 'Hora de fin']);

                // Iterar sobre las filas de la tabla de horarios
                for (var j = 1; j < tablaHorarios.rows.length; j++) {
                    var filaHorario = tablaHorarios.rows[j];
                    var dia = filaHorario.cells[0].innerText;
                    var turno = filaHorario.cells[1].innerText;
                    var nivel = filaHorario.cells[2].innerText;
                    var horaInicio = filaHorario.cells[3].innerText;
                    var horaFin = filaHorario.cells[4].innerText;

                    // Agregar los datos de horario al array
                    datos.push([dia, turno, nivel, horaInicio, horaFin]);
                }

                // Agregar una fila vacía para separar los horarios de diferentes profesores
                datos.push([]);
            }

            // Crear una hoja de cálculo
            var workbook = XLSX.utils.book_new();
            var worksheet = XLSX.utils.aoa_to_sheet(datos);

            // Agregar la hoja de cálculo al libro
            XLSX.utils.book_append_sheet(workbook, worksheet, 'Horarios');

            // Convertir el libro a un archivo binario
            var excelBuffer = XLSX.write(workbook, { bookType: 'xlsx', type: 'array' });

            // Crear un Blob a partir del archivo binario
            var blob = new Blob([excelBuffer], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });

            // Descargar el archivo Excel
            saveAs(blob, 'horarios.xlsx');
        }
    </script>




    <?php if(session('create') == 'Registro agregado correctamente'): ?>
        <script>
            Swal.fire(
                'Registrado!',
                'Se Registró correctamente.',
                'success'
            )
        </script>
    <?php endif; ?>
    <?php if(session('update') == 'Registro actualizado correctamente'): ?>
        <script>
            Swal.fire(
                'Actualizado!',
                'Se Actualizó correctamente.',
                'success'
            )
        </script>
    <?php endif; ?>
    <?php if(session('delete') == 'Registro eliminado correctamente'): ?>
        <script>
            Swal.fire(
                'Eliminado!',
                'Se eliminó correctamente.',
                'error'
            )
        </script>
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Control-Asistencia\resources\views/horario/index.blade.php ENDPATH**/ ?>