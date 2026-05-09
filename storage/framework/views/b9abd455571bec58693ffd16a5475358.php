<?php $__env->startSection('title', 'Qr'); ?>
<?php $__env->startSection('plugins.Sweetalert2', true); ?>

<?php $__env->startSection('head'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content_header'); ?>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><i
                                    class="nav-icon fas fa-th mr-2"></i>Escritorio</a></li>
                        <li class="breadcrumb-item active"><i class="fas fa-fw fa-share mr-2"></i>QR</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-dark">
                    <div class="card-header">
                        <h4 class="card-title">Generador de Codigo QR</h4>

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
                        <form method="post" action="<?php echo e(route('qr.store')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="dni">Ingrese DNI del profesor:</label>
                                <input type="text" class="form-control" id="dni" name="DNI" maxlength="8" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Generar QR</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <?php if(session('qrCode')): ?>
                    <div class="card card-dark">
                        <div class="card-header">
                            <h4 class="card-title">Codigo Generado</h4>
                        </div>
                        <div class="card-body text-center" id="printableArea">
                            <img src="<?php echo e(asset('qrcodes/' . session('qrCode'))); ?>" alt="Código QR del profesor" class="img-fluid">
                            <div class="mt-4">
                                <h5>Datos del Profesor</h5>
                                <p><strong>Nombre:</strong> <?php echo e(session('profesor')->nombres); ?></p>
                                <p><strong>Apellidos:</strong> <?php echo e(session('profesor')->apellidos); ?></p>
                                <p><strong>DNI:</strong> <?php echo e(session('profesor')->DNI); ?></p>
                                <!-- Agrega aquí cualquier otro dato del profesor que desees mostrar -->
                            </div>
                            <a href="<?php echo e(asset('qrcodes/' . session('qrCode'))); ?>" download="QR_<?php echo e(session('profesor')->nombres); ?>_<?php echo e(session('profesor')->apellidos); ?>.png" class="btn btn-primary mt-2">Descargar Código QR</a>
                            <a href="<?php echo e(asset(session('pdfPath'))); ?>" target="_blank" class="btn btn-primary">Descargar PDF</a>

                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>


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

    <!-- scripts para funcionalidad de tabla profesional-->

    <script>
        $(document).ready(function() {
        $('#tbmantenimiento').DataTable({
            "order": [[0, "desc"]], // Esto ordenará la primera columna (N°) de forma descendente al cargar la tabla
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
            "lengthMenu": [
                [5, 10, 50, -1],
                [5, 10, 50, "All"]
            ]
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
    <?php if(session('create') == 'Codigo Qr Generado'): ?>
        <script>
            Swal.fire(
                'Generado!',
                'Codigo Qr Generado Correctamente',
                'success'
            )
        </script>
    <?php endif; ?>
    <?php if(session('error') == 'El DNI proporcionado no existe en la base de datos.'): ?>
        <script>
            Swal.fire(
                'ERROR!',
                'El DNI proporcionado no existe',
                'error'
            )
        </script>
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Control-Asistencia\resources\views/qr/index.blade.php ENDPATH**/ ?>