<?php $__env->startSection('title', 'Qr'); ?>
<?php $__env->startSection('plugins.Sweetalert2', true); ?>

<?php $__env->startSection('head'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><i
                                    class="nav-icon fas fa-th mr-2"></i>Escritorio</a></li>
                        <li class="breadcrumb-item active"><i class="fas fa-fw fa-share mr-2"></i>Lector</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
            <div class="card card-dark">
                <div class="card-header">
                    <h4 class="card-title">Lector</h4>
                </div>
                <div class="card-body text-center">
                    <div class="col-sm-7 shadow p-5 mx-auto">
                        <h5 class="text-center">Escanear codigo QR</h5>
                        <div class="row justify-content-center align-items-center text-center">
                            <a id="btn-scan-qr" href="#">
                                <img src="https://dab1nmslvvntp.cloudfront.net/wp-content/uploads/2017/07/1499401426qr_icon.svg" class="img-fluid text-center" width="175">
                            </a>
                            <canvas hidden="" id="qr-canvas" class="img-fluid"></canvas>
                        </div>

                        <div class="row mx-6 my-4 justify-content-center text-center">
                            <button class="btn btn-success btn-sm rounded-3 ml-2" onclick="encenderCamara()">Encender camara</button>
                            <button class="btn btn-danger btn-sm rounded-3 ml-2" onclick="cerrarCamara()">Detener camara</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <!-- estilos para tablas profesionales datatable-->
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.bootstrap5.min.css">

    <!-- estilos para botones de exportación-->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">


<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <!-- scripts para tablas profesionales-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"></script>

    <!-- scripts para exportación de archivos-->
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>

    <script src="<?php echo e(asset('js/qrCode.min.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsqr@1.3.1/dist/jsQR.js"></script>


    <script>
        //crea elemento
        const video = document.createElement("video");

        //nuestro camvas
        const canvasElement = document.getElementById("qr-canvas");
        // const canvas = canvasElement.getContext("2d");

        const canvas = canvasElement.getContext("2d", { willReadFrequently: true });


        //div donde llegara nuestro canvas
        const btnScanQR = document.getElementById("btn-scan-qr");

        //lectura desactivada
        let scanning = false;

        //funcion para encender la camara
        const encenderCamara = () => {
        navigator.mediaDevices
            .getUserMedia({ video: { facingMode: "environment" } })
            .then(function (stream) {
            scanning = true;
            btnScanQR.hidden = true;
            canvasElement.hidden = false;
            video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
            video.srcObject = stream;
            video.play();
            tick();
            scan();
            });
        };

        //funciones para levantar las funiones de encendido de la camara
        function tick() {
        canvasElement.height = video.videoHeight;
        canvasElement.width = video.videoWidth;
        canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);

        scanning && requestAnimationFrame(tick);
        }

        function scan() {
         try {
             qrcode.decode();
         } catch (e) {
             setTimeout(scan, 300);
         }
         }

        //apagara la camara
        const cerrarCamara = () => {
        video.srcObject.getTracks().forEach((track) => {
            track.stop();
        });
        canvasElement.hidden = true;
        btnScanQR.hidden = false;
        };
        qrcode.callback = (respuesta) => {
            if (respuesta) {
                // URL del controlador en Laravel al que se enviará el dato
                const url = 'registro';
                // Datos a enviar
                const data = { qrData: respuesta };

                // Configuración de la solicitud
                const requestOptions = {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Asegúrate de tener la meta etiqueta csrf-token en tu HTML
                    },
                    body: JSON.stringify(data)
                };
                fetch(url, requestOptions)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Registro agregado correctamente',
                            type: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            location.reload(); // Recargar la página
                        });
                        // activarSonido();
                    } else {
                        Swal.fire('Error', data.message, 'error');
                    }
                    cerrarCamara();
                })
                .catch((error) => {
                    console.error('Error:', error);
                    Swal.fire('Error', 'No se pudo registrar el código QR', 'error');
                    cerrarCamara();
                });



            }
        };

        //evento para mostrar la camara sin el boton
        window.addEventListener('load', (e) => {
        encenderCamara();
        })

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Control-Asistencia\resources\views/lector/index.blade.php ENDPATH**/ ?>