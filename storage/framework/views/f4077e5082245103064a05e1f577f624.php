<!-- Ventana modal para Editar -->
<div class="modal fade" id="editar<?php echo e($profesor->id); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header bg-warning">
                <h6 class="modal-title text-center" style="color: #fff; text-align: center;">
                    Editar Categoría
                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <?php echo Form::model($profesor, [
                'method' => 'PATCH',
                'route' => ['profesor.update', $profesor->id],
            ]); ?>

            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="modal-body" id="cont_modal">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombres">Nombre:</label>
                            <input type="text" id="nombres" name="nombres" class="form-control" value="<?php echo e($profesor->nombres); ?>">
                        </div>
                        <div class="form-group">
                            <label for="apellidos">Apellido:</label>
                            <input type="text" id="apellidos" name="apellidos" class="form-control" value="<?php echo e($profesor->apellidos); ?>">
                        </div>
                        <div class="form-group">
                            <label for="numero">Numero:</label>
                            <input type="text" id="numero" name="numero" class="form-control" value="<?php echo e($profesor->numero); ?>">
                        </div>
                        <div class="form-group">
                            <label for="DNI">DNI:</label>
                            <input type="text" id="DNI" name="DNI" class="form-control" value="<?php echo e($profesor->DNI); ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="correo">Correo:</label>
                            <input type="text" id="correo" name="correo" class="form-control" value="<?php echo e($profesor->correo); ?>">
                        </div>
                        <div class="form-group">
                            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control" value="<?php echo e($profesor->fecha_nacimiento); ?>">
                        </div>
                        <div class="form-group">
                            <label for="genero">Género:</label>
                            <select id="genero" name="genero" class="form-control">
                                <option value="masculino" <?php echo e($profesor->genero == 'masculino' ? 'selected' : ''); ?>>Masculino</option>
                                <option value="femenino" <?php echo e($profesor->genero == 'femenino' ? 'selected' : ''); ?>>Femenino</option>
                                <option value="otro" <?php echo e($profesor->genero == 'otro' ? 'selected' : ''); ?>>Otro</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </div>

            <?php echo Form::close(); ?>



        </div>
    </div>
</div>
<!---fin ventana Editar--->
<?php /**PATH C:\laragon\www\Control-Asistencia\resources\views/profesor/modal/editar.blade.php ENDPATH**/ ?>