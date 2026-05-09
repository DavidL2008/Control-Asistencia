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
                        <li class="breadcrumb-item active"><i class="fas fa-fw fa-share mr-2"></i>Profesores</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


    <div class="section-body">

        <div class="row">

            <!-- Nuevo Cuadro para Registro de Profesores -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card card-dark">
                    <div class="card-header">
                        <h4 class="card-title">Registro de Profesores</h4>
                    </div>
                    <div class="card-body">
                        <?php echo Form::open(['route' => 'profesor.store', 'method' => 'POST', 'onsubmit' => 'return validarCorreo()']); ?>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombres">Nombre:</label>
                                        <input type="text" id="nombres" name="nombres" class="form-control" value="<?php echo e(old('nombres')); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="apellidos">Apellido:</label>
                                        <input type="text" id="apellidos" name="apellidos" class="form-control" value="<?php echo e(old('apellidos')); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="numero">Número:</label>
                                        <input type="text" id="numero" name="numero" maxlength="9" class="form-control" value="<?php echo e(old('numero')); ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dni">DNI:</label>
                                        <input type="text" id="dni" name="DNI" maxlength="8" class="form-control" value="<?php echo e(old('DNI')); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="correo">Correo:</label>
                                        <input type="text" id="correo" name="correo" class="form-control" value="<?php echo e(old('correo')); ?>" required>
                                        <small class="text-muted" id="error-correo" style="display: none;">Por favor, ingrese un correo electrónico válido.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                                        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control" value="<?php echo e(old('fecha_nacimiento')); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="genero">Género:</label>
                                        <select id="genero" name="genero" class="form-control">
                                            <option value="masculino" <?php echo e(old('genero') == 'masculino' ? 'selected' : ''); ?>>Masculino</option>
                                            <option value="femenino" <?php echo e(old('genero') == 'femenino' ? 'selected' : ''); ?>>Femenino</option>
                                            <option value="otro" <?php echo e(old('genero') == 'otro' ? 'selected' : ''); ?>>Otro</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar</button>
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
                                    <input type="hidden" name="tipo" value="profesores"> <!-- Agrega el parámetro tipo=profesores -->
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-success"><i class="fas fa-file-pdf"></i> Generar PDF </button>
                                </form>
                            </div>
                            <div class="btn-group" role="group" aria-label="Generar Excel">
                            <a id="generar-reporte-btn" class="btn btn-primary w-50 px-5">Generar Reporte</a>
                            
                                <!-- <button onclick="generarExcel()" class="btn btn-success"><i class="fas fa-file-excel"></i> Generar Excel</button> -->
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
                                    <th>Teléfono</th>
                                    <th>Correo</th>
                                    <th>Fecha de nacimiento</th>
                                    <th>Genero</th>
                                    <th width="15px">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $profesores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profesor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($profesor->id); ?></td>
                                        <td><?php echo e($profesor->nombres); ?></td>
                                        <td><?php echo e($profesor->apellidos); ?></td>
                                        <td><?php echo e($profesor->DNI); ?></td>
                                        <td><?php echo e($profesor->numero); ?></td>
                                        <td><?php echo e($profesor->correo); ?></td>
                                        <td><?php echo e($profesor->fecha_nacimiento); ?></td>
                                        <td><?php echo e($profesor->genero); ?></td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#mostrar<?php echo e($profesor->id); ?>">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                                data-target="#editar<?php echo e($profesor->id); ?>">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#eliminar<?php echo e($profesor->id); ?>">
                                                <i class="far fa-trash-alt icon-size"></i>
                                            </button>
                                        </td>
                                        <!--Ventana Modal para la Alerta de mostrar--->
                                        <?php echo $__env->make('profesor.modal.editar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php echo $__env->make('profesor.modal.eliminar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </tr>
                                    <div class="modal fade" id="mostrar<?php echo e($profesor->id); ?>" tabindex="-1" role="dialog"
                                        aria-labelledby="modalLabel<?php echo e($profesor->id); ?>" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalLabel<?php echo e($profesor->id); ?>">Código QR de <?php echo e($profesor->nombres); ?> <?php echo e($profesor->apellidos); ?></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <!-- Mostrar el código QR -->
                                                    <!-- <img src="data:image/png;base64,<?php echo e(base64_encode($profesor->qr_code)); ?>" alt="Código QR de <?php echo e($profesor->nombres); ?> <?php echo e($profesor->apellidos); ?>" class="img-fluid"> -->
                                                    <img src="<?php echo e(asset('qrcodes/' . $profesor->qr_code)); ?>" alt="Código QR de <?php echo e($profesor->nombres); ?> <?php echo e($profesor->apellidos); ?>" class="img-fluid">
                                                    <a href="<?php echo e(asset('qrcodes/' . $profesor->qr_code)); ?>" download="QR_<?php echo e($profesor->nombres); ?>_<?php echo e($profesor->apellidos); ?>.png" class="btn btn-primary mt-2">Descargar Código QR</a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
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







    <!-- use version 0.20.2 -->
    <script lang="javascript" src="https://cdn.sheetjs.com/xlsx-0.20.2/package/dist/xlsx.full.min.js"></script>



    
    <!-- scripts para funcionalidad de tabla profesional-->

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
        function validarCorreo() {
            var correoInput = document.getElementById("correo");
            var correo = correoInput.value;

            // Expresión regular para validar el formato del correo electrónico
            var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            // Verificar si el formato del correo electrónico es válido
            if (!regex.test(correo)) {
                var errorCorreo = document.getElementById("error-correo");
                errorCorreo.innerHTML = "Por favor, ingrese un correo electrónico válido.";
                errorCorreo.style.display = "block"; // Mostrar mensaje de error
                correoInput.focus();
                return false;
            }

            // Array de dominios permitidos
            var dominiosPermitidos = ['miempresa.com', 'gmail.com', 'hotmail.com', 'yahoo.com', 'universidad.edu'];

            // Obtener el dominio del correo electrónico
            var dominio = correo.split('@')[1];

            // Verificar si el dominio del correo electrónico está en la lista de dominios permitidos
            if (dominiosPermitidos.indexOf(dominio) === -1) {
                var errorCorreo = document.getElementById("error-correo");
                errorCorreo.innerHTML = "Por favor, ingrese un correo electrónico con uno de los dominios permitidos.";
                errorCorreo.style.display = "block"; // Mostrar mensaje de error
                correoInput.focus();
                return false;
            }

            return true;
        }
    </script>

<!-- <script>
    // Función para generar el archivo Excel
    function generarExcel() {
        // Datos de la tabla
        var tabla = document.getElementById('tbmantenimiento');
        var datos = [['Nombres', 'Apellidos', 'DNI', 'Teléfono', 'Correo', 'Fecha de Nacimiento', 'Género']];

        // Iterar sobre las filas de la tabla para obtener los datos
        for (var i = 1; i < tabla.rows.length; i++) {
            var fila = tabla.rows[i];
            var nombre = fila.cells[1].innerText;
            var apellido = fila.cells[2].innerText;
            var dni = fila.cells[3].innerText;
            var telefono = fila.cells[4].innerText;
            var correo = fila.cells[5].innerText;
            var fechaNacimiento = fila.cells[6].innerText;
            var genero = fila.cells[7].innerText;

            // Agregar los datos de la fila al array
            datos.push([nombre, apellido, dni, telefono, correo, fechaNacimiento, genero]);
        }

        // Crear una hoja de cálculo
        var workbook = XLSX.utils.book_new();
        var worksheet = XLSX.utils.aoa_to_sheet(datos);

        // Agregar la hoja de cálculo al libro
        XLSX.utils.book_append_sheet(workbook, worksheet, 'Profesores');

        // Convertir el libro a un archivo binario
        var excelBuffer = XLSX.write(workbook, { bookType: 'xlsx', type: 'array' });

        // Crear un Blob a partir del archivo binario
        var blob = new Blob([excelBuffer], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });

        // Descargar el archivo Excel
        saveAs(blob, 'profesores.xlsx');
    }
</script> -->



<script>
        var profesores = <?php echo $profesores; ?>;

        document.getElementById('generar-reporte-btn').addEventListener('click', function () {
            // Crear una nueva hoja de cálculo de SheetJS
            var workbook = XLSX.utils.book_new();

            // Convertir los datos JSON a una hoja de cálculo de SheetJS
            var worksheet = XLSX.utils.json_to_sheet(profesores);

            // Agregar la hoja de cálculo al libro
            XLSX.utils.book_append_sheet(workbook, worksheet, 'Profesores');

            // Guardar el libro como archivo Excel
            XLSX.writeFile(workbook, 'reporte.xlsx');
        });
    </script>




<!-- 
        <script>
            $.('#dni').keyup(function(e){
                e.preventDefault();
                dni=$('#dni').val();
                $.ajax({
                    url: '/fetch-dni-data',//funcion consultadni
                    type:'POST',
                    // data: 'dni='+dni,
                    data: {
                            dni: dni,
                            _token: '<?php echo e(csrf_token()); ?>' // Add CSRF token
                        },
                    dataType: 'json',
                    success: function(resultado){

                        if(respuesta.dni==dni){
                            $('nombres').val(repuesta.nombres)
                            $('apellidos').val(respuesta.apellidoPaterno + ' ' + repsuesta.apellidoMaterno);

                        }
                    }

                })
            })
        </script> -->
        <script>
            $(document).ready(function() {
                $('#dni').keyup(function(e) {
                    e.preventDefault();
                    let dni = $('#dni').val();

                    $.ajax({
                        url: <?php echo e(url('fetch-dni-data')); ?>,
                        type: 'POST',
                        data: {
                            dni: dni
                        },
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Ensure you have the meta tag csrf-token in your HTML
                        },
                        dataType: 'json',
                        success: function(respuesta) {
                            if (respuesta.dni === dni) {
                                $('#nombres').val(respuesta.nombres);
                                $('#apellidos').val(respuesta.apellidoPaterno + ' ' + respuesta.apellidoMaterno);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                });
            });
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
<?php $__env->stopSection(); ?>



<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Control-Asistencia\resources\views/profesor/index.blade.php ENDPATH**/ ?>