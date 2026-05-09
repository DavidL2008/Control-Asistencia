<?php $__env->startSection('title', 'Profesores'); ?>
<?php $__env->startSection('plugins.Sweetalert2', true); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><i
                                    class="nav-icon fas fa-th mr-2"></i>Escritorio</a></li>
                        <li class="breadcrumb-item active"><i class="fas fa-fw fa-share mr-2"></i>Detalles</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


    <div class="section-body">

        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card card-dark">
                    <div class="card-header">
                        <h4 class="card-title">Registro de Profesores</h4>
                    </div>
                    <div class="card-body">
                        <?php echo Form::open(['route' =>'profesordetalle.store', 'method' => 'POST']); ?>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Cargo:</label>
                                        <?php echo e(Form::select('cargo_id', $cargoProfesordetalle, $profesordetalle->cargo_id,
                                        ['class' => 'form-control' . ($errors->has('cargo_id') ? ' is-invalid' : ''),
                                        'id' => 'cargocrear', 'style' => 'width: 100%',
                                        'placeholder' => 'Elegir cargo', 'data-allow-clear' => 'true'])); ?>

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Profesor:</label>
                                        <?php echo e(Form::select('profesor_id', $profesorProfesordetalle, $profesordetalle->profesor_id,
                                        ['class' => 'form-control' . ($errors->has('profesor_id') ? ' is-invalid' : ''),
                                        'id' => 'profesorcrear', 'style' => 'width: 100%',
                                        'placeholder' => 'Elegir profesor', 'data-allow-clear' => 'true'])); ?>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Area:</label>
                                        <?php echo e(Form::select('area_id', $areaProfesordetalle, $profesordetalle->area_id,
                                        ['class' => 'form-control' . ($errors->has('area_id') ? ' is-invalid' : ''),
                                        'id' => 'areacrear', 'style' => 'width: 100%',
                                        'placeholder' => 'Elegir Area'])); ?>

                                    </div>
                                    <div class="form-group">
                                        <label for="horario">Horario:</label>
                                        <?php echo e(Form::select('horario_id', $horarioProfesordetalle, $profesordetalle->horario_id,
                                        ['class' => 'form-control' . ($errors->has('horario_id') ? ' is-invalid' : ''),
                                        'id' => 'horariocrear', 'style' => 'width: 100%',
                                        'placeholder' => 'Elegir Horario'])); ?>

                                    </div>

                                </div>
                            </div>
                        <button type="submit" class="btn btn-primary mb-1">Guardar</button>
                        <?php echo Form::close(); ?>


                    </div>
                </div>
            </div>

            <!-- crud para módulo de profesores -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <div class="card card-dark">

                    <div class="card-header">
                        <h4 class="card-title">Listado de Profesores</h4>

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

                        <div class="btn-toolbar" role="toolbar">
                            <div class="btn-group mr-2" role="group" aria-label="Generar PDF">
                                <form action="<?php echo e(route('generar.pdf')); ?>" method="GET" target="_blank">
                                    <input type="hidden" name="tipo" value="profesordetalles"> <!-- Agrega el parámetro tipo=profesores -->
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
                                    <th>Numero</th>
                                    <th>correo</th>
                                    <th>Fecha nacimiento</th>
                                    <th>Genero</th>
                                    <th>Cargo</th>
                                    <th>Area</th>
                                    <th>Horario</th>
                                    <th width="15px">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $profesordetalles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profesordetalle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($profesordetalle->id); ?></td>
                                        <td><?php echo e($profesordetalle->profesor->nombres); ?></td>
                                        <td><?php echo e($profesordetalle->profesor->apellidos); ?></td>
                                        <td><?php echo e($profesordetalle->profesor->DNI); ?></td>
                                        <td><?php echo e($profesordetalle->profesor->numero); ?></td>
                                        <td><?php echo e($profesordetalle->profesor->correo); ?></td>
                                        <td><?php echo e($profesordetalle->profesor->fecha_nacimiento); ?></td>
                                        <td><?php echo e($profesordetalle->profesor->genero); ?></td>
                                        <td><?php echo e($profesordetalle->cargo->descripcion); ?></td>
                                        <td><?php echo e($profesordetalle->area->descripcion); ?></td>
                                        <td>
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Día</th>
                                                            <th>Turno</th>
                                                            <th>Nivel</th>
                                                            <th>Entrada</th>
                                                            <th>Salida</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $__currentLoopData = $profesordetalle->profesor->horarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $horario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr>
                                                                <td><?php echo e($horario->dia_semana); ?></td>
                                                                <td><?php echo e($horario->turno); ?></td>
                                                                <td><?php echo e($horario->nivel_educativo); ?></td>
                                                                <td><?php echo e(\Carbon\Carbon::parse($horario->hora_inicio)->format('h:i A')); ?></td>
                                                                <td><?php echo e(\Carbon\Carbon::parse($horario->hora_fin)->format('h:i A')); ?></td>
                                                                <!--Ventana Modal para la Alerta de mostrar--->

                                                            </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tbody>
                                                </table>
                                            </td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#mostrar<?php echo e($profesordetalle->id); ?>">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                                data-target="#editar<?php echo e($profesordetalle->id); ?>">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#eliminar<?php echo e($profesordetalle->id); ?>">
                                                <i class="far fa-trash-alt icon-size"></i>
                                            </button>
                                        </td>
                                        <!--Ventana Modal para la Alerta de mostrar--->
                                        <?php echo $__env->make('profesordetalle.modal.editar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php echo $__env->make('profesordetalle.modal.eliminar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<?php $__env->stopSection(); ?>
<!-- CSS adicional para corregir estilos de Bootstrap -->

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
    <!-- Agrega el script de jQuery UI Autocomplete -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.2/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>





    <!-- scripts para funcionalidad de tabla profesional-->


    <!--Condicionales para las alertas , con las variables del (with) de los controladores-->
    <script>
        $(document).ready(function() {
            $('#tbmantenimiento').DataTable({
                "order": [[0, "desc"]],
                //traduccion datatable
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
                var nombres = fila.cells[1].innerText;
                var apellidos = fila.cells[2].innerText;
                var dni = fila.cells[3].innerText;
                var numero = fila.cells[4].innerText;
                var correo = fila.cells[5].innerText;
                var fechaNacimiento = fila.cells[6].innerText;
                var genero = fila.cells[7].innerText;
                var cargo = fila.cells[8].innerText;
                var area = fila.cells[9].innerText;

                // Agregar los datos del profesor
                datos.push(['Nombres', nombres]);
                datos.push(['Apellidos', apellidos]);
                datos.push(['DNI', dni]);
                datos.push(['Numero', numero]);
                datos.push(['Correo', correo]);
                datos.push(['Fecha nacimiento', fechaNacimiento]);
                datos.push(['Genero', genero]);
                datos.push(['Cargo', cargo]);
                datos.push(['Area', area]);
                datos.push([]); // Fila vacía

                // Agregar encabezado de horarios
                datos.push(['Día', 'Turno', 'Nivel', 'Entrada', 'Salida']);

                // Obtener la tabla de horarios para el profesor actual
                var tablaHorarios = fila.querySelector('.table');

                // Iterar sobre las filas de la tabla de horarios
                for (var j = 1; j < tablaHorarios.rows.length; j++) {
                    var filaHorario = tablaHorarios.rows[j];
                    var dia = filaHorario.cells[0].innerText;
                    var turno = filaHorario.cells[1].innerText;
                    var nivel = filaHorario.cells[2].innerText;
                    var entrada = filaHorario.cells[3].innerText;
                    var salida = filaHorario.cells[4].innerText;

                    // Agregar los datos de horario al array
                    datos.push([dia, turno, nivel, entrada, salida]);
                }

                // Agregar una fila vacía para separar los datos de diferentes profesores
                datos.push([]);
            }

            // Crear una hoja de cálculo
            var workbook = XLSX.utils.book_new();
            var worksheet = XLSX.utils.aoa_to_sheet(datos);

            // Agregar la hoja de cálculo al libro
            XLSX.utils.book_append_sheet(workbook, worksheet, 'Detalles');

            // Convertir el libro a un archivo binario
            var excelBuffer = XLSX.write(workbook, { bookType: 'xlsx', type: 'array' });

            // Crear un Blob a partir del archivo binario
            var blob = new Blob([excelBuffer], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });

            // Descargar el archivo Excel
            saveAs(blob, 'Detalles.xlsx');
        }
    </script>

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
    <?php if(session('warning') == 'El Profesor y el Horario deben ser iguales.'): ?>
        <script>
            Swal.fire(
                'Error!',
                'El Profesor y el Horario deben ser iguales.',
                'error'
            )
        </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Control-Asistencia\resources\views/profesordetalle/index.blade.php ENDPATH**/ ?>