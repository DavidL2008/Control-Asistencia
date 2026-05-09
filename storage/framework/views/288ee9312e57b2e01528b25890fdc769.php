<?php $__env->startSection('title', 'Usuarios'); ?>
<?php $__env->startSection('plugins.Sweetalert2', true); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><i
                                    class="nav-icon fas fa-th mr-2"></i>Escritorio</a></li>
                        <li class="breadcrumb-item active"><i class="fas fa-users fa-fw mr-2"></i>Usuarios</li>
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
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">

                <div class="card card-dark">

                    <div class="card-header">
                        <h4 class="card-title">Lista de Usuarios</h4>

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

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('crear-usuario')): ?>
                            <button type="button" class="btn btn-primary mb-1" data-toggle="modal"
                                data-target="#crear"><strong>Nuevo</strong>
                                <i class="fas fa-file"></i>
                            </button>
                            <!--Ventana Modal para crear--->
                            <?php echo $__env->make('usuarios.modal.crear', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>

                        <hr>

                        <table id="tbuser"
                            class="table table-sm table-striped table-hover table-bordered shadow-lg  dt-responsive nowrap"
                            style="width:100%">

                            <thead class="text-white" style="background-color:#6777ef">
                                <tr class="active">
                                    <th width="15px">#</th>
                                    <th>Nombre</th>
                                    <th>E-mail</th>
                                    <th>Estado</th>
                                    <th>Rol</th>
                                    <th width="15px">Acciones</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($usuario->id); ?></td>
                                        <td><?php echo e($usuario->name); ?></td>
                                        <td><?php echo e($usuario->email); ?></td>
                                        <td>
                                            <?php if($usuario->estado): ?>
                                                <span class="badge badge-success">
                                                    <form method="post"
                                                        action="<?php echo e(url('/camestadousu/' . $usuario->id)); ?>">
                                                        <?php echo csrf_field(); ?>
                                                        <button class="btn btn-sm btn-block btn-success">Activo <i
                                                                class="fas fa-check-circle"></i>
                                                        </button>
                                                    </form>
                                                </span>
                                            <?php else: ?>
                                                <span class="badge badge-danger">
                                                    <form method="post"
                                                        action="<?php echo e(url('/camestadousu/' . $usuario->id)); ?>">
                                                        <?php echo csrf_field(); ?>
                                                        <button class="btn btn-sm btn-block btn-danger">Inactivo <i
                                                                class="fas fa-ban"></i>
                                                        </button>
                                                    </form>
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if(!empty($usuario->getRoleNames())): ?>
                                                <?php $__currentLoopData = $usuario->getRoleNames(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rolNombre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <h5>
                                                        <span class="badge badge-dark"><?php echo e($rolNombre); ?></span>
                                                    </h5>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <!-- boton para editar -->
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#mostrar<?php echo e($usuario->id); ?>">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <!-- boton para editar -->

                                            <!-- boton para editar -->
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('editar-usuario')): ?>
                                                <a class="btn btn-warning btn-sm"
                                                    href="<?php echo e(route('usuarios.edit', $usuario->id)); ?>"><i
                                                        class="fas fa-edit"></i></a>
                                            <?php endif; ?>
                                            <!-- fin boton editar -->

                                            <!-- boton para eliminar -->
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('borrar-usuario')): ?>
                                                <?php echo Form::open([
                                                    'method' => 'DELETE',
                                                    'route' => ['usuarios.destroy', $usuario->id],
                                                    'class' => 'formulario-eliminar',
                                                    'style' => 'display:inline',
                                                ]); ?>

                                                <?php echo e(Form::button('<i class="far fa-trash-alt icon-size"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-danger'])); ?>

                                                <?php echo Form::close(); ?>

                                            <?php endif; ?>
                                            <!-- fin boton eliminar -->
                                        </td>
                                        <!--Ventana Modal para la Alerta de Eliminar--->
                                        <?php echo $__env->make('usuarios.modal.crear', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <!--Ventana Modal para la Alerta de Eliminar--->
                                        <?php echo $__env->make('usuarios.modal.mostrar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Control-Asistencia\resources\views/usuarios/index.blade.php ENDPATH**/ ?>