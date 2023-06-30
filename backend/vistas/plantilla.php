<?php
    session_start();
    $ruta = ControladorRuta::ctrRuta();
    $rutaBackend = ControladorRuta::ctrRutaBackend();
    $rutaServidor = ControladorRuta::ctrRutaServidor();

    if(isset($_SESSION["idBackend"])) {
        $usuarioIngreso = ControladorUsuarios::ctrMostrarUsuarios("id", $_SESSION["idBackend"]);
        $noticiasPublicadas = ControladorUsuarios::ctrDatosPublicadosPorUsuario("noticia", $_SESSION["idBackend"]);
        $videosPublicados = ControladorUsuarios::ctrDatosPublicadosPorUsuario("video", $_SESSION["idBackend"]);
        $documentosSubidos = ControladorUsuarios::ctrDatosPublicadosPorUsuario("documento", $_SESSION["idBackend"]);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MEFCCA | Admin</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="vistas/img/icono.png">

    <!--====================================================
        VINCULOS CSS
    =====================================================-->

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css"
        integrity="zmfNZmXoNWBMemUOo1XUGFfc0ihGGLYdgtJS3KCr/l0=">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="vistas/css/plugins/OverlayScrollbars.min.css">

    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="vistas/css/plugins/tempusdominus-bootstrap-4.min.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="vistas/css/plugins/select2.min.css">
    
    <!-- Theme style AdmninLTE -->
    <link rel="stylesheet" href="vistas/css/plugins/adminlte.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="vistas/css/plugins/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="vistas/css/plugins/responsive.bootstrap.min.css">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="vistas/css/plugins/sweetalert2.min.css">

    <!-- Datepicker -->
    <link rel="stylesheet" href="vistas/css/plugins/bootstrap-datepicker.min.css">

    <!-- Estilos CSS Originales -->
    <link rel="stylesheet" href="vistas/css/main.css">

    <!--=====================================
	VÍNCULOS JAVASCRIPT
	======================================-->
    <!-- jQuery 3 -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

    <!-- overlayScrollbars -->
    <script src="vistas/js/plugins/jquery.overlayScrollbars.min.js"></script>

    <!-- bs-custom-file-input -->
    <script src="vistas/js/plugins/bs-custom-file-input.min.js"></script>

    <!-- Moment -->
    <script src="vistas/js/plugins/moment.min.js"></script>

    <!-- Select2 -->
    <script src="vistas/js/plugins/select2.full.min.js"></script>

    <!-- Datepicker -->
    <script src="vistas/js/plugins/bootstrap-datepicker.min.js"></script>
    <script src="vistas/js/plugins/bootstrap-datepicker.es.min.js"></script>

    <!-- Tempusdominus Bootstrap 4 -->
    <script src="vistas/js/plugins/tempusdominus-bootstrap-4.min.js"></script>

    <!-- InputMask -->
    <script src="vistas/js/plugins/jquery.inputmask.bundle.js"></script>
    <script src="vistas/js/plugins/moment.min.js"></script>

    <!-- AdminLTE App -->
    <script src="vistas/js/plugins/adminlte.min.js"></script>

    <!-- DataTables https://datatables.net/-->
    <script src="vistas/js/plugins/jquery.dataTables.min.js"></script>
    <script src="vistas/js/plugins/dataTables.bootstrap4.min.js"></script>
    <script src="vistas/js/plugins/dataTables.responsive.min.js"></script>
    <script src="vistas/js/plugins/responsive.bootstrap.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.6/dist/sweetalert2.min.js" integrity="sha256-ytBPHlXtZUPR29lnLm6p+dZYwAU+g0XpyMsWD4i0lH4=" crossorigin="anonymous"></script>

    <!-- CKEDITOR -->
	<script src="vistas/js/plugins/ckeditor.js"></script>

    <!-- CKEDITOR Version Spanish -->
    <!-- <script src="vistas/js/plugins/es.js"></script> -->

    <!-- Usuarios -->
    <script src="vistas/js/usuarios.js"></script>

    <!-- Banner -->
    <script src="vistas/js/banner.js"></script>

    <!-- Noticias -->
    <script src="vistas/js/noticias.js"></script>

    <!-- Estructura -->
    <script src="vistas/js/estructura.js"></script>

    <!-- Documentos -->
    <script src="vistas/js/documentos.js"></script>

    <!-- Videos -->
    <script src="vistas/js/videos.js"></script>

    <!-- Delegaciones -->
    <script src="vistas/js/delegaciones.js"></script>

    <!-- Programa de Radio -->
    <script src="vistas/js/radio.js"></script>
    
    <!-- Transmisiones -->
    <script src="vistas/js/transmisiones.js"></script>

    <!-- Iniciar bs-custom-file-input -->
    <script type="text/javascript">
        $(document).ready(function() {
            bsCustomFileInput.init();
            $('[data-mask]').inputmask();
        });
    </script>

    <!-- Main -->
    <script src="vistas/js/main.js"></script>

</head>

<?php if(!isset($_SESSION["validarSesionBackend"])):
    include "paginas/login.php";
?>
<?php else: ?>

<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">

    <?php

        $inatividad = 3600;

        if(isset($_SESSION["timeout"])){

            $sessionTTL = time() - $_SESSION["timeout"];
            
            if($sessionTTL > $inatividad){

                session_destroy();

                echo '
                    <script>
                        Swal.fire({
                            icon: "info",
                            title: "La sesion ha experido!",
                            text: "Por favor, vuelva a ingresar",
                            confirmButtonText: "Aceptar"
                        }).then((result) => {
                            
                            if (result.isConfirmed) {
                                window.location = "'.$rutaBackend.'";
                            }
                            
                        });
                    </script>
                ';

            } else {
                
                $_SESSION["timeout"] = time();

            }
        }

    ?>

    <div class="wrapper">

        <?php

            include 'paginas/modulos/header.php';

            include 'paginas/modulos/menu.php';

            // ====================================================== //
            // ================ Navegacion de paginas =============== //
            // ====================================================== //
            if(isset($_GET["pagina"])) {
                if($_GET["pagina"] == "inicio" ||
                    $_GET["pagina"] == "usuarios" ||
                    $_GET["pagina"] == "banner" ||
                    $_GET["pagina"] == "videos" ||
                    $_GET["pagina"] == "noticias" ||
                    $_GET["pagina"] == "document" ||
                    $_GET["pagina"] == "estructura" ||
                    $_GET["pagina"] == "delegaciones" ||
                    $_GET["pagina"] == "radio" ||
                    $_GET["pagina"] == "transmisiones" ||
                    $_GET["pagina"] == "salir" ||
                    $_GET["pagina"] == "ajustes") {
                        include "paginas/".$_GET["pagina"].".php";
                } else {
                    include "paginas/error404.php";
                }
            } else {
                include 'paginas/inicio.php';
            }

            include 'paginas/modulos/footer.php';
        ?>
    </div> <!-- ./wrapper -->
</body>
<?php endif ?>

</html>
