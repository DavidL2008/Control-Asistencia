<?php $__env->startSection('title', 'Roles'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><i
                                    class="nav-icon fas fa-th mr-2"></i>Escritorio</a></li>
                        <li class="breadcrumb-item active"><i class="nav-icon fa fa-table mr-2"></i>Mantenimiento</li>
                        <li class="breadcrumb-item active"><i class="fas fa-user-lock mr-2"></i>Roles</li>
                        <li class="breadcrumb-item active"><i class="fas fa-file mr-2"></i>Altas de Roles</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <!-- incluir mensajes de acciones -->

    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-sm-10">
                <div class="card card-info">

                    <div class="card-header">
                        <h4 class="card-title">Alta de Roles</h4>
                    </div>

                    <div class="card-body">

                        <?php echo Form::open(['route' => 'roles.store', 'method' => 'POST']); ?>


                        <!-- formulario--->
                        <?php echo $__env->make('roles.partials.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <?php echo Form::close(); ?>


                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="/css/admin_custom.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        console.log('Hi!');
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Control-Asistencia\resources\views/roles/crear.blade.php ENDPATH**/ ?>