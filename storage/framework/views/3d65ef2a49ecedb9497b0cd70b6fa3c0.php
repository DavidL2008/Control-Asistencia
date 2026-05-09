<!-- Ventana modal para mostrar -->

<div class="modal fade" id="mostrar<?php echo e($usuario->id); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">

                <h6 class="modal-title text-center" style="color: #fff; text-align: center;">
                    Detalle de Usuario
                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body mt-4 text-left">
                <p><strong>Nombres: </strong> <?php echo e($usuario->name); ?> </p>
                <p><strong>Email: </strong> <?php echo e($usuario->email); ?></p>
                <p><strong>Estado: </strong>
                    <?php if($usuario->estado): ?>
                        <h5>
                            <span class="badge badge-success">Activo</span>
                        </h5>
                    <?php else: ?>
                        <h5>
                            <span class="badge badge-danger">Inactivo</span>
                        </h5>
                    <?php endif; ?>
                </p>
                <p><strong>Rol: </strong>
                    <?php if(!empty($usuario->getRoleNames())): ?>
                        <?php $__currentLoopData = $usuario->getRoleNames(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rolNombre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <h5>
                                <span class="badge badge-danger"><?php echo e($rolNombre); ?></span>
                            </h5>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </p>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cerrar</button>
            </div>


        </div>
    </div>
</div>
<!---fin ventana mostrar--->
<?php /**PATH C:\laragon\www\Control-Asistencia\resources\views/usuarios/modal/mostrar.blade.php ENDPATH**/ ?>