<?php $__env->startSection('title', 'Roles'); ?>
<?php $__env->startSection('plugins.Sweetalert2', true); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><i
                                    class="nav-icon fas fa-th mr-2"></i>Escritorio</a></li>
                        <li class="breadcrumb-item active"><i class="fas fa-user-lock mr-2"></i>Roles</li>
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

            <!-- crud para modulo de estados de obras -->
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                <div class="card card-dark">

                    <div class="card-header">
                        <h4 class="card-title">Roles de Usuario</h4>

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

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('crear-rol')): ?>
                            <a class="btn btn-primary mb-1" href="<?php echo e(route('roles.create')); ?>"><i class="fas fa-file"></i>
                                Nuevo</a>
                        <?php endif; ?>

                        <hr>

                        <table id="tbuser"
                            class="table table-sm table-striped table-hover table-bordered shadow-lg  dt-responsive nowrap"
                            style="width:100%">
                            <thead class="text-white" style="background-color:#6777ef">
                                <tr class="active">
                                    <th width="15px">#</th>
                                    <th>Rol</th>
                                    <th width="30px">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($role->id); ?></td>
                                        <td><?php echo e($role->name); ?></td>
                                        <td>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('editar-rol')): ?>
                                                <a class="btn btn-warning btn-sm" href="<?php echo e(route('roles.edit', $role->id)); ?>"><i
                                                        class="fas fa-edit"></i></a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('borrar-rol')): ?>
                                            <!-- boton para eliminar -->
                                            <?php echo Form::open([
                                                'method' => 'DELETE',
                                                'route' => ['roles.destroy', $role->id],
                                                'class' => 'formulario-eliminar',
                                                'style' => 'display:inline',
                                            ]); ?>

                                            <button type="button" class="btn btn-sm btn-danger" id="btn-eliminar">
                                                <i class="far fa-trash-alt icon-size"></i>
                                            </button>
                                            <!-- fin boton eliminar -->
                                            <?php endif; ?>
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



<!-- links para estilos css -->
<?php $__env->startSection('css'); ?>
    <?php echo $__env->make('roles.partials.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<!-- links de scripts -->
<?php $__env->startSection('js'); ?>
    <?php echo $__env->make('roles.partials.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        document.getElementById('btn-eliminar').addEventListener('click', function(event) {
            console.log('Botón de eliminar clicado');
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Control-Asistencia\resources\views/roles/index.blade.php ENDPATH**/ ?>