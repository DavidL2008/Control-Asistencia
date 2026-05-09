<?php $__env->startSection('title', 'Registros'); ?>
<?php $__env->startSection('plugins.Sweetalert2', true); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><i
                                    class="nav-icon fas fa-th mr-2"></i>Escritorio</a></li>
                        <li class="breadcrumb-item active"><i class="fas fa-fw fa-share mr-2"></i>Registros</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


    <div class="section-body">

        <div class="row">

            <!-- crud para módulo de profesores -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <div class="card card-dark">

                    <div class="card-header">
                        <h4 class="card-title">Registro de Entrada</h4>

                        <div class="card-tools">
                            <!-- This will cause the card to maximize when clicked -->
                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                    class="fas fa-expand"></i></button>
                            <!-- This will cause the card to collapse when clicked -->
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                            <!-- This will cause the card to be removed when clicked -->
                        </div>
                        <!-- /.card-tools -->

                    </div>

                    <div class="card-body">

                        <div class="card-header">
                            <h4 class="card-title">Registro de Profesores</h4>
                        </div>
                        <div class="card-body">
                            <?php echo Form::open(['route' => 'registro.store', 'method' => 'POST']); ?>

                                <div class="form-group">
                                    <label for="dni">DNI:</label>
                                    <input type="text" id="dni" name="DNI" maxlength="8" class="form-control" value="<?php echo e(old('DNI')); ?>">
                                </div>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            <?php echo Form::close(); ?>

                        </div>
                        <hr>

                        <div class="btn-toolbar" role="toolbar">
                            <div class="btn-group mr-2" role="group" aria-label="Generar PDF">
                                <form action="<?php echo e(route('generar.pdf')); ?>" method="GET" target="_blank">
                                    <input type="hidden" name="tipo" value="registros"> <!-- Agrega el parámetro tipo=profesores -->
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-success"><i class="fas fa-file-pdf"></i> Generar PDF </button>
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
                                <tr class="active">
                                    <th width="15px">N°</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>DNI</th>
                                    <th>Nivel</th>
                                    <th>Turno</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Estado</th>
                                    <th>Asistencia</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $registros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($registro->id); ?></td>
                                        <td><?php echo e($registro->profesor->nombres); ?></td>
                                        <td><?php echo e($registro->profesor->apellidos); ?></td>
                                        <td><?php echo e($registro->profesor->DNI); ?></td>
                                        <td><?php echo e($registro->horario->nivel_educativo); ?></td>
                                        <td><?php echo e($registro->horario->turno); ?></td>
                                        <td><?php echo e($registro->fecha_registro); ?></td>
                                        <td><?php echo e(\Carbon\Carbon::parse($registro->hora_registro)->format('h:i A')); ?></td>
                                        <td><?php echo e($registro->estado); ?></td>
                                        <td class="text-center <?php echo e($registro->asistencia === 'Puntual' ? 'bg-success text-white' : ($registro->asistencia === 'Tardanza' ? 'bg-warning text-white' : ($registro->asistencia === 'Falta' ? 'bg-danger text-white' : 'bg-info text-white'))); ?>">
                                            <?php echo e($registro->asistencia); ?>

                                        </td>
                                        <!--Ventana Modal para la Alerta de mostrar--->

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

    <!-- scripts para tablas profesionales-->
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.3/xlsx.full.min.js"></script>

    <!-- scripts para funcionalidad de tabla profesional-->

    <script>
        $(document).ready(function() {
            $('#tbmantenimiento').DataTable({
                "order": [[0, "desc"]],
                //traduccion datatable
                "language": {
                    "lengthMenu": "Mostrar " +
                        '<select class="custom-select custom-select-sm form-control form-control-sm"><option value="10">10</option><option value="15">15</option><option value="20">20</option><option value="25">25</option><option value="-1">All</option></select>' +
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
                    [10, 50, -1],
                    [10, 50, "All"]
                ]

            });

        });
    </script>
    <script>
        // Función para generar el archivo Excel
        function generarExcel() {
            // Datos de la tabla
            var tabla = document.getElementById('tbmantenimiento');
            var datos = [['N°', 'Nombres', 'Apellidos', 'DNI', 'Nivel', 'Turno', 'Fecha', 'Hora', 'Estado', 'Asistencia']];

            // Iterar sobre las filas de la tabla para obtener los datos
            for (var i = 1; i < tabla.rows.length; i++) {
                var fila = tabla.rows[i];
                var numero = fila.cells[0].innerText;
                var nombre = fila.cells[1].innerText;
                var apellido = fila.cells[2].innerText;
                var dni = fila.cells[3].innerText;
                var nivel = fila.cells[4].innerText;
                var turno = fila.cells[5].innerText;
                var fecha = fila.cells[6].innerText;
                var hora = fila.cells[7].innerText;
                var estado = fila.cells[8].innerText;
                var asistencia = fila.cells[9].innerText;

                // Agregar los datos de la fila al array
                datos.push([numero, nombre, apellido, dni, nivel, turno, fecha, hora, estado, asistencia]);
            }

            // Crear una hoja de cálculo
            var workbook = XLSX.utils.book_new();
            var worksheet = XLSX.utils.aoa_to_sheet(datos);

            // Agregar la hoja de cálculo al libro
            XLSX.utils.book_append_sheet(workbook, worksheet, 'Registros');

            // Convertir el libro a un archivo binario
            var excelBuffer = XLSX.write(workbook, { bookType: 'xlsx', type: 'array' });

            // Crear un Blob a partir del archivo binario
            var blob = new Blob([excelBuffer], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });

            // Descargar el archivo Excel
            saveAs(blob, 'Registro.xlsx');
        }
    </script>
    <!--Condicionales para las alertas , con las variables del (with) de los controladores-->

    <?php if(session('delete') == 'Registro eliminado correctamente'): ?>
        <script>
            Swal.fire(
                'Eliminado!',
                'Se eliminó correctamente.',
                'error'
            )
        </script>
    <?php endif; ?>
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
    <?php if(session('error') == 'No se encontró un horario registrado para el profesor'): ?>
        <script>
            Swal.fire(
                'ERROR!',
                'Horario no existe.',
                'error'
            )
        </script>
    <?php endif; ?>
    <?php if(session('error') == 'El profesor con el DNI proporcionado no existe'): ?>
        <script>
            Swal.fire(
                'ERROR!',
                'DNI no existe',
                'error'
            )
        </script>
    <?php endif; ?>
    <?php if(session('error') == 'No hay horarios registrados para el día de hoy'): ?>
        <script>
            Swal.fire(
                'ERROR!',
                'No hay horarios registrado para el día de hoy',
                'error'
            )
        </script>
    <?php endif; ?>
    <?php if(session('error') == 'Registro en horas no asignadas'): ?>
        <script>
            Swal.fire(
                'ERROR!',
                'Horas no asignadas',
                'error'
            )
        </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Control-Asistencia\resources\views/registro/index.blade.php ENDPATH**/ ?>