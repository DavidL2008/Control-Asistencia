<!-- Ventana modal para Editar -->
<div class="modal fade" id="editar<?php echo e($horario->id); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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

            <?php echo Form::model($horario, [
                'method' => 'PATCH',
                'route' => ['horario.update', $horario->id],
            ]); ?>

            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="modal-body" id="cont_modal">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="profesor_id">Profesor:</label>
                            <?php echo e(Form::select('profesor_id', $profesorProfesor, $profesor->profesor_id,
                                                ['class' => 'form-control' . ($errors->has('profesor_id') ? ' is-invalid' : ''),
                                                'id' => 'profesor_id', 'style' => 'width: 100%',
                                                'placeholder' => 'Elegir Profesor'])); ?>

                        </div>

                        <div class="form-group">
                            <label for="nivel_educativo">Nivel Educativo:</label>
                            <select name="nivel_educativo" id="nivel_educativo" class="form-control">
                                <option value="Inicial" <?php echo e($horario->nivel_educativo == 'inicial' ? 'selected' : ''); ?>>inicial</option>
                                <option value="Primaria" <?php echo e($horario->nivel_educativo == 'primaria' ? 'selected' : ''); ?>>primaria</option>
                                <option value="Secundaria" <?php echo e($horario->nivel_educativo == 'secundaria' ? 'selected' : ''); ?>>secundaria</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="turno">Turno:</label>
                            <select name="turno" id="turno" class="form-control">
                                <option value="mañana" <?php echo e($horario->turno == 'mañana' ? 'selected' : ''); ?>>mañana</option>
                                <option value="tarde" <?php echo e($horario->turno == 'tarde' ? 'selected' : ''); ?>>tarde</option>
                                <option value="ambos" <?php echo e($horario->turno == 'ambos' ? 'selected' : ''); ?>>ambos</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dia_semana">Día de la semana:</label>
                            <select name="dia_semana" id="dia_semana" class="form-control">
                                <option value="Lunes" <?php echo e($horario->dia_semana == 'Lunes' ? 'selected' : ''); ?>>Lunes</option>
                                <option value="Martes" <?php echo e($horario->dia_semana == 'Martes' ? 'selected' : ''); ?>>Martes</option>
                                <option value="Miércoles" <?php echo e($horario->dia_semana == 'Miercoles' ? 'selected' : ''); ?>>Miercoles</option>
                                <option value="Jueves" <?php echo e($horario->dia_semana == 'Jueves' ? 'selected' : ''); ?>>Jueves</option>
                                <option value="Viernes" <?php echo e($horario->dia_semana == 'Viernes' ? 'selected' : ''); ?>>Viernes</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="hora_inicio">Hora de inicio:</label>
                            <input type="time" name="hora_inicio" id="hora_inicio" class="form-control" value="<?php echo e($horario->hora_inicio); ?>">
                        </div>

                        <div class="form-group">
                            <label for="hora_fin">Hora de fin:</label>
                            <input type="time" name="hora_fin" id="hora_fin" class="form-control" value="<?php echo e($horario->hora_fin); ?>">
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
<?php /**PATH C:\laragon\www\Control-Asistencia\resources\views/horario/modal/editar.blade.php ENDPATH**/ ?>