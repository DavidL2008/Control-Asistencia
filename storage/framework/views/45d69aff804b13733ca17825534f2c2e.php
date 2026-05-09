<!-- Ventana modal para Crear -->

<div class="modal fade" id="crear" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header" style="background-color: #0085e0 !important;">

                <h4 class="modal-title text-center" style="color: #fff; text-align: center;">
                    Crear Usuario
                </h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <?php echo Form::open(['route' => 'usuarios.store', 'method' => 'POST']); ?>


            <div class="modal-body" id="cont_modal">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>"
                            placeholder="Ingrese el nombre de usuario">
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
                        <label for="password">Contraseña</label>
                        <?php echo Form::password('password', ['class' => 'form-control']); ?>

                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="confirm-password">Confirmar Contraseña</label>
                        <?php echo Form::password('confirm-password', ['class' => 'form-control']); ?>

                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="select">Roles</label>
                        <?php echo Form::select('roles[]', $roles, [], ['class' => 'form-control']); ?>

                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancelar</button>
                </div>
            </div>


            <?php echo Form::close(); ?>

        </div>
    </div>
</div>
<!---fin ventana Crear--->
<?php /**PATH C:\laragon\www\Control-Asistencia\resources\views/usuarios/modal/crear.blade.php ENDPATH**/ ?>