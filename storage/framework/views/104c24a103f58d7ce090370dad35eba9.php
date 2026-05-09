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
                        <li class="breadcrumb-item active"><i class="fas fa-edit mr-2"></i>Actualizar Rol</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <!-- incluir mensajes de acciones -->


    <section class="section">
        <div class="section-body">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card card-info">


                        <div class="card-header">
                            <h4 class="card-title">Actualización de Roles</h4>
                        </div>

                        <div class="card-body">

                            <?php echo Form::model($role, ['method' => 'PATCH', 'route' => ['roles.update', $role->id]]); ?>

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="">Nombre del Rol:</label>
                                        <?php echo Form::text('name', null, ['class' => 'form-control']); ?>

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="">Permisos para este Rol:</label>
                                        <br />
                                        <?php $__currentLoopData = $permission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <label><?php echo e(Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, ['class' => 'name'])); ?>

                                                <?php echo e($value->name); ?></label>
                                            <br />
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <a type="button" class="btn btn-secondary ml-2" href="<?php echo e(route('roles.index')); ?>">
                                    Cancelar</a>

                            </div>
                            <?php echo Form::close(); ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="/css/admin_custom.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        console.log('Hi!');
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Control-Asistencia\resources\views/roles/editar.blade.php ENDPATH**/ ?>