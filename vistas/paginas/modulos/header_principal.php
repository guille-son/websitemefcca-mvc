<?php
$banner = ControladorBanner::ctrMostrarBanner();
$radioInicioPrincipal = ControladorRadio::ctrMostrarRadioPrincipal();
?>

<header class="encabezado_sitio inicio">
    <div class='contenedor_slider'>
        <div class="contenido_encabezado">
            <div class="contenido_radio">
                <div class="logotipos">
                    <a href="<?php echo $ruta; ?>" class="logo">
                        <img src="img/Logo_Mefcca.svg" alt="Logotipo MEFCCA">
                    </a>
                    <a href="<?php echo $ruta; ?>" class="logo">
                        <img src="img/Logo_Gobierno.svg" alt="Logotipo GOBIERNO">
                    </a>
                </div>
                <h1 class="">Ministerio <br> de Economía Familiar Comunitaria Cooperativa y Asociativa</h1>
                <div class="opciones_radio">
                    <a href="#" class="btn_menu_radio" data-pushbar-target="pushbar_menu_radio"><i class="fas fa-bars" aria-hidden="true"></i></a>
                    <div class="reproductor_radio">
                        <div id="wrapper">
                            <audio preload="auto" controls>
                                <source src="<?php echo $servidor . $radioInicioPrincipal[0]['linkPrograma']; ?>" />
                            </audio>
                        </div>
                        <!-- <label class="limitar_una_linea" for="">Nombre del Programa de Radio</label> -->
                    </div>
                </div>
                <div class="boton_menu">
                    <a href="#" class="boton btn_estilo_uno" data-pushbar-target="pushbar_menu">Menú <i class="fas fa-plus icono_boton"></i></a>
		    <nav class="redes_sociales rs_footer">
		        <a href="https://es-la.facebook.com/ministeriodeeconomiafamiliar/" target="_blank" class="facebook"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
		        <a href="https://www.instagram.com/mefcca_nic/?hl=es-la" target="_blank" class="instagram"><i class="fab fa-instagram" aria-hidden="true"></i></a>
		        <a href="https://twitter.com/MEFCCANic?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor" target="_blank" class="twitter"><i class="fab fa-twitter" aria-hidden="true"></i></a>
		        <a href="https://www.youtube.com/channel/UCMHl3nIh_inJS_HhV2FCLNQ" target="_blank" class="youtube"><i class="fab fa-youtube"></i></a>
		    </nav>

                </div>
            </div>

            <div class="imagen_hoja">
                <img src="img/header/Hojas.1.png" alt="Imagen Hoja">
            </div>

            <div class="wavi">
                <img src="img/header/wave-mefcca.png" alt="">
            </div>
        </div>
        <div class="slider">
            <?php foreach ($banner as $key => $value) : ?>
                <div>
                    <img src="<?php echo $servidor . $value['img']; ?>" alt="">
                </div>
            <?php endforeach ?>
        </div>
    </div>

    <?php include 'vistas/paginas/modulos/menu.php'; ?>
</header>
