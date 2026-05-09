<!-- Ventana modal para Crear -->

<div class="modal fade" id="crear" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header" style="background-color: #0085e0 !important;">
                <h6 class="modal-title text-center" style="color: #fff; text-align: center;">
                    Crear Categoria de Trabajador
                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <?php echo Form::open(['route' => 'cargo.store', 'method' => 'POST']); ?>

            <div class="modal-body" id="cont_modal">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="">Descripcion: </label>
                        <input type="text" name="descripcion" class="form-control" value="<?php echo e(old('descripcion')); ?>">
                    </div>
                </div>


            </div>


            <div class="modal-footer">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancelar</button>
                </div>
            </div>

            <?php echo Form::close(); ?>

        </div>
    </div>
</div>
<!---fin ventana Crear--->
<?php /**PATH C:\laragon\www\Control-Asistencia\resources\views/cargo/modal/crear.blade.php ENDPATH**/ ?>