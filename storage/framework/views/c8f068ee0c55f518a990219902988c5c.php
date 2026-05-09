<!-- Ventana modal para Editar -->

<div class="modal fade" id="eliminar<?php echo e($profesor->id); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header bg-danger">
                <h6 class="modal-title text-center" style="color: #fff; text-align: center;">
                    Eliminar Categoría
                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <?php echo Form::model($profesor, [
                'method' => 'DELETE',
                'route' => ['profesor.destroy', $profesor->id],
            ]); ?>

            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <div class="modal-body" id="cont_modal">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <h5 style="text-align: center;">La registro se eliminara</h5>
                    <h5 style="text-align: center;"><strong>¿Estas de acuerdo?</strong></h5>
                </div> 
            </div>

            <div class="modal-footer">
                <div class="col-xs-12 col-sm-12 col-md-12">

                    <button type="submit" class="btn btn-primary">Aceptar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> Omitir</button>
                </div>
            </div>

            <?php echo Form::close(); ?>


        </div>
    </div>
</div>
<!---fin ventana Editar--->
<?php /**PATH C:\laragon\www\Control-Asistencia\resources\views/profesor/modal/eliminar.blade.php ENDPATH**/ ?>