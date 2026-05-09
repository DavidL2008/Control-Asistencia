<!-- Ventana modal para Editar -->

<div class="modal fade" id="editar<?php echo e($cargo->id); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header bg-warning">
                <h6 class="modal-title text-center" style="color: #fff; text-align: center;">
                    Editar Categoría
                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <?php echo Form::model($cargo, [
                'method' => 'PATCH',
                'route' => ['cargo.update', $cargo->id],
            ]); ?>

            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="modal-body" id="cont_modal">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="">Cargo: </label>
                        <input type="text" name="descripcion" class="form-control" value="<?php echo e($cargo->descripcion); ?>">
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
<!---fin ventana Editar--->
<?php /**PATH C:\laragon\www\Control-Asistencia\resources\views/cargo/modal/editar.blade.php ENDPATH**/ ?>