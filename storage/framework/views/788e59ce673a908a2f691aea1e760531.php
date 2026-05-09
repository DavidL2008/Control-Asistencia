<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
        <label for="">Nombre del Rol:</label>
        <?php echo Form::text('name', null, ['class' => 'form-control']); ?>

    </div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
        <h3>Lista de permisos :</h3>
        <hr>
        <br />
        <?php $__currentLoopData = $permission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <label><?php echo e(Form::checkbox('permission[]', $value->id, false, ['class' => 'name'])); ?>

                <?php echo e($value->name); ?>

            </label>

            <br />
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12">
    <button type="submit" class="btn btn-primary">Guardar</button>
    <a type="button" class="btn btn-secondary" href="<?php echo e(route('roles.index')); ?>"> Cancelar</a>
</div>
<?php /**PATH C:\laragon\www\Control-Asistencia\resources\views/roles/partials/form.blade.php ENDPATH**/ ?>