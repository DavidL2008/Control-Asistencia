<?php $__env->startSection('title', 'Usuarios'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="content-header row">
        <div class="content-header-left col-md-12 col-12 mb-1">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><i
                                    class="fas fa-fw fa-home mr-2"></i>Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo e(route('usuarios.index')); ?>"><i
                                    class="fas fa-users fa-fw mr-2"></i>Usuarios</a></li>
                        <li class="breadcrumb-item active"><i class="fas fa-edit mr-2"></i>Actualización de Usuarios</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <!-- incluir mensajes de acciones -->


    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card card-info">

                    <div class="card-header">
                        <h4 class="card-title">Actualización de Usuario</h4>
                    </div>

                    <div class="card-body">

                        <?php echo Form::model($user, ['method' => 'PATCH', 'route' => ['usuarios.update', $user->id]]); ?>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <?php echo Form::text('name', null, ['class' => 'form-control']); ?>

                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <?php echo Form::text('email', null, ['class' => 'form-control']); ?>

                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="">Roles</label>
                                    <?php echo Form::select('roles[]', $roles, $userRole, ['class' => 'form-control']); ?>

                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <a class="btn btn-secondary m-2" href="<?php echo e(route('usuarios.index')); ?>">Cancelar</a>
                            </div>
                        </div>
                    </div>
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

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Control-Asistencia\resources\views/usuarios/editar.blade.php ENDPATH**/ ?>