<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Profesores</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Importar CSS de Bootstrap si aún no está incluido -->

    <style>
        /* Estilos para la tabla */
        #tbmantenimiento {
            font-size: 12px; /* Tamaño de la fuente */
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Lista profesores</h2>
    <table id="tbmantenimiento"
        class="table table-sm table-striped table-hover table-bordered shadow-lg  dt-responsive nowrap"
        style="width:100%">
        <thead class="text-white" style="background-color:#6777ef">
            <tr class="active">
                <th width="15px">N°</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>DNI</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Fecha de nacimiento</th>
                <th>Genero</th>

            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $profesores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profesor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($profesor->id); ?></td>
                    <td><?php echo e($profesor->nombres); ?></td>
                    <td><?php echo e($profesor->apellidos); ?></td>
                    <td><?php echo e($profesor->DNI); ?></td>
                    <td><?php echo e($profesor->numero); ?></td>
                    <td><?php echo e($profesor->correo); ?></td>
                    <td><?php echo e($profesor->fecha_nacimiento); ?></td>
                    <td><?php echo e($profesor->genero); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

</body>
</html>


<?php /**PATH C:\laragon\www\Control-Asistencia\resources\views/profesor/pdf.blade.php ENDPATH**/ ?>