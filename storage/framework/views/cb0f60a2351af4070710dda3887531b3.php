<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Bienvenido <?php echo e(Auth::user()->name); ?></h1>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <?php
    use App\Models\cargo;
    $cant_cargo = cargo::count();
    ?>
    <?php
    use App\Models\area;
    $cant_area = area::count();
    ?>
    <?php
    use App\Models\horario;
    $cant_horario = horario::count();
    ?>
    <?php
    use App\Models\profesor;
    $cant_profesor = profesor::count();
    ?>
    <?php
    use App\Models\profesordetalle;
    $cant_profesordetalle = profesordetalle::count();
    ?>
    <?php
    use App\Models\registro;
    $cant_registro = registro::count();
    ?>

    <div class="row">
        <div class="col-lg-12">

            <div class="card card-dark">
                <div class="card-header">
                    <h4 class="card-title">Accesos</h4>

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
                    <div class="row">
                        <?php if(Auth::user()->can('ver-cargo')): ?>
                            <div class="col-md-4 col-xl-3">
                                <div class="small-box bg-gradient-info">
                                    <div class="inner">
                                        <h3><span><?php echo e($cant_cargo); ?></span></h3>
                                        <p>Cargo</p>
                                    </div>
                                    <div class="icon">
                                        <i class="far fa-address-card"></i>
                                    </div>
                                    <a href="cargo" class="small-box-footer">
                                            Acceder <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if(Auth::user()->can('ver-area')): ?>
                            <div class="col-md-4 col-xl-3">
                                <div class="small-box bg-gradient-success">
                                    <div class="inner">
                                        <h3><span><?php echo e($cant_area); ?></span></h3>
                                        <p>Area</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-award"></i>
                                    </div>
                                    <a href="area" class="small-box-footer">
                                        Acceder <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if(Auth::user()->can('ver-horario')): ?>
                            <div class="col-md-4 col-xl-3">
                                <div class="small-box bg-secondary">
                                    <div class="inner">
                                        <h3><span><?php echo e($cant_horario); ?></span></h3>
                                        <p>Horario</p>
                                    </div>
                                    <div class="icon">
                                        <i class="far fa-calendar-alt"></i>
                                    </div>
                                    <a href="horario" class="small-box-footer">
                                        Acceder <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>

                            </div>
                        <?php endif; ?>

                        <?php if(Auth::user()->can('ver-profesor')): ?>
                            <div class="col-md-4 col-xl-3">
                                <div class="small-box bg-gradient-warning">
                                    <div class="inner">
                                        <h3><span><?php echo e($cant_profesor); ?></span></h3>
                                        <p>Profesor</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-chalkboard-teacher"></i>
                                    </div>
                                    <a href="profesor" class="small-box-footer">
                                        Acceder <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if(Auth::user()->can('ver-profesordetalle')): ?>
                            <div class="col-md-4 col-xl-3">
                                <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h3><span><?php echo e($cant_profesordetalle); ?></span></h3>
                                        <p>Detalle</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-sitemap"></i>
                                    </div>
                                    <a href="profesordetalle" class="small-box-footer">
                                        Acceder <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if(Auth::user()->can('ver-registro')): ?>
                            <div class="col-md-4 col-xl-3">
                                <div class="small-box bg-dark">
                                    <div class="inner">
                                        <h3><span>0</span></h3>
                                        <p>Registro</p>
                                    </div>
                                    <div class="icon">
                                        <i class="far fa-clipboardx"></i>
                                    </div>
                                    <a href="registro" class="small-box-footer">
                                        Acceder <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if(Auth::user()->can('ver-qr')): ?>
                            <div class="col-md-4 col-xl-3">
                                <div class="small-box bg-light">
                                    <div class="inner">
                                        <?php
                                        ?>
                                        <h3><span>0</span></h3>
                                        <p>Generador QR</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-qrcode"></i>
                                    </div>
                                    <a href="qr" class="small-box-footer">
                                        Acceder <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Control-Asistencia\resources\views/dashboard/index.blade.php ENDPATH**/ ?>