<!-- resources/views/qr/pdfblade.php -->
<!-- <!DOCTYPE html>
<html>
<head>
    <title>Profesor PDF</title>
</head>
<body>
    <h1>Detalles del Profesor</h1>
    <p>Nombre: <?php echo e($profesor->nombres); ?></p>
    <p>Nombre: <?php echo e($profesor->apellidos); ?></p>
    <p>DNI: <?php echo e($profesor->DNI); ?></p>
    <p>Código QR:</p>
    <img src="<?php echo e(public_path('qrcodes/' . $profesor->qr_code)); ?>" alt="QR Code">
</body>
</html> -->
<!-- <!DOCTYPE html>
<html>
<head>
    <title>Profesor PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
            color: #4CAF50;
        }
        .profesor-details {
            margin-top: 20px;
        }
        .profesor-details p {
            font-size: 16px;
            line-height: 1.5;
        }
        .profesor-details img {
            display: block;
            margin: 20px auto;
            border: 2px solid #4CAF50;
            padding: 10px;
        }
        .profesor-details .qr-code {
            text-align: center;
            margin-top: 30px;
        }
        .profesor-details .info {
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>Detalles del Profesor</h1>
    <div class="profesor-details">
        <div class="info">
            <p><strong>Nombre y apellidos:</strong> <?php echo e($profesor->nombres); ?> <?php echo e($profesor->apellidos); ?></p>
            <p><strong>DNI:</strong> <?php echo e($profesor->DNI); ?></p>
        </div>
        <div class="qr-code">
            <p><strong>Código QR:</strong></p>
            <img src="<?php echo e(public_path('qrcodes/' . $profesor->qr_code)); ?>" alt="QR Code">
        </div>
    </div>
</body>
</html> -->

<!DOCTYPE html>
<html>
<head>
    <title>Profesor PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            /* background-color: #f2f2f2; */
        }
        .card {
            background: #ffffff;
            width: 350px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            text-align: center;
            margin-left:180px;
        }
        .card-header {
            background-color: #0056b3;
            color: white;
            padding: 15px;
        }
        .card-header img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }
        .card-body {
            padding: 20px;
        }
        .card-body img {
            width: 400px;
            height: 400px;
            border-radius: 50%;
            margin-top: 15px;
        }
        .card-body h2 {
            margin: 10px 0;
            font-size: 20px;
            color: #333333;
        }
        .card-body p {
            margin: 5px 0;
            font-size: 14px;
            color: #777777;
        }
        .card-footer {
            background-color: #f7f7f7;
            padding: 10px;
            border-top: 1px solid #e6e6e6;
        }
        .card-footer p {
            margin: 5px 0;
            font-size: 12px;
            color: #999999;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRoV6AjRE3Zs6HFgYl_0z4oRH5tq4Ed-H5eyA&s" alt="Logo">
            <h1>Detalles del Profesor</h1>
        </div>
        <div class="card-body">
            <img src="<?php echo e(public_path('qrcodes/' . $profesor->qr_code)); ?>" alt="QR Code">
            <h2><?php echo e($profesor->nombres); ?> <?php echo e($profesor->apellidos); ?></h2>
            <p>DNI: <?php echo e($profesor->DNI); ?></p>
        </div>
        <div class="card-footer">
            <p>Generado el: <?php echo e(\Carbon\Carbon::now()->format('d/m/Y')); ?></p>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\laragon\www\Control-Asistencia\resources\views/qr/pdf.blade.php ENDPATH**/ ?>