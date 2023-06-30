<?php
include "modulos/header_principal.php";
?>

<?php
$noticiasInicio = ControladorNoticiasInicio::ctrMostrarNoticiasInicio();
$noticia = "noticia-";
$pleca = "/";

$videosInicio = ControladorVideosInicio::ctrMostrarVideosInicio();

$paginaEnTrabajo = true;
?>

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js">
</script>

<main id="inicio" class="seccion contenedor">
    <div class="centrar_boton_seccion">
        <a href="<?php echo $ruta; ?>notimefcca" class="boton btn_estilo_uno">NotiMefcca
            <i class="fas fa-arrow-right icono_boton"></i></a>
    </div>
    <ul class="lista_personalizada contenedor_notimefcca clearfix">
        <?php foreach ($noticiasInicio as $key => $valueNoticia) : ?>
            <?php $url = ControladorUrlAmigable::ctrUrlAmigable($valueNoticia['titulo']); ?>
            <?php $id = $valueNoticia['id']; ?>
            <li class="noticia">
                <img src="<?php echo $servidor . $valueNoticia['imagen_noticia']; ?>" alt="Imagen Noticia">
                <div class="contenido_noticia">
                    <div class="encabezado_noticia">
                        <h2 class="limitar_tres_lineas"><?php echo $valueNoticia['titulo']; ?></h2>
                        <div class="lista_detalle_noticia">
                            <p><i class="far fa-calendar" aria-hidden="true"></i>
                                <span><?php echo $valueNoticia['fecha']; ?></span>
                            </p>
                            <p><i class="far fa-clock" aria-hidden="true"></i>
                                <span><?php echo $valueNoticia['hora']; ?></span>
                            </p>
                            <p><i class="far fa-user" aria-hidden="true"></i>
                                <span><?php echo $valueNoticia['nombre_completo'] ?></span>
                            </p>
                        </div>
                    </div>
                    <p class="limitar_dos_lineas"><?php echo $valueNoticia['descripcion_corta']; ?></p>
                    <div class="pie_noticia">
                        <nav class="redes_sociales">
                            <?php $url = ControladorUrlAmigable::ctrUrlAmigable($valueNoticia['titulo']); ?>

                            <a href="<?php echo 'https://www.facebook.com/share.php?u=' . $ruta . $noticia . $url . $pleca . $valueNoticia['id'] ?>" target="_blank" class="facebook"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
                            <a href="<?php echo 'https://web.whatsapp.com/send?text=' . $ruta . $noticia . $url . $pleca . $valueNoticia['id'] ?>" target="_blank" class="whatsapp"><i class="fab fa-whatsapp"></i></a>
                            <a href="<?php echo 'https://twitter.com/share?url=' . $ruta . $noticia . $url . $pleca . $valueNoticia['id'] ?>" target="_blank" class="twitter"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                        </nav>
                        <a href="<?php echo $ruta . $noticia . $url . $pleca . $id; ?>" class="boton btn_estilo_dos">Ver más <i class="fas fa-arrow-right icono_arrow icono_boton"></i></a>
                    </div>
                </div>
            </li>
        <?php endforeach ?>
    </ul>
</main>

<section id="paginacion" class="seccion seccion_documentos paginacion">

    <div class="contenedor">
        <div class="centrar_boton_seccion">
            <div>
                <a href="<?php echo $ruta; ?>documentos/" class="boton btn_borde_blanco">Documentos<i class="fas fa-arrow-right icono_boton"></i></a>
            </div>
            <div id="cajaBusqueda" class="caja_buscar">
                <input id="txtBusqueda" class="texto_buscar" type="search" placeholder="Buscar Documentos">
                <i id="cancelarBusqueda" class="cancelInicio cancelSearch far fa-times-circle"></i>
                <a id="btnBuscar" class="btn_buscar"><i class="fas fa-search" aria-hidden="true"></i></a>
            </div>
        </div>

        <div id="documentosInicio" class="paginacionContent">
            <ul id="listPage" class="lista_personalizada contenedor_documentos clearfix my-shuffle-container"></ul>

            <div class="holderContent">
                <div id="holder" class="holder ocultarItem"></div>
            </div>
        </div>

    </div>
</section>

<!-- Seccion Slide BioClima -->
<section id="videosSinPaginar" class="seccion seccion_expo">
    <div class="contenedor">
        <div class="centrar_boton_seccion">
            <div>
                <a target="__blank" href="http://www.marena.gob.ni/Enderedd/proyectobioclima/" class="boton btn_borde_blanco">Proyecto BioClima <i class="fas fa-arrow-right icono_boton"></i></a>
            </div>
        </div>
        <div class="contenedor_videos clearfix row">
            <div class="link-expo col-12">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="4000">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="https://www.economiafamiliar.gob.ni/websitemefcca-mvc/vistas/img/bioclima/01.jpg" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="https://www.economiafamiliar.gob.ni/websitemefcca-mvc/vistas/img/bioclima/02.jpg" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="https://www.economiafamiliar.gob.ni/websitemefcca-mvc/vistas/img/bioclima/03.jpg" alt="Third slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="https://www.economiafamiliar.gob.ni/websitemefcca-mvc/vistas/img/bioclima/04.jpg" alt="Fourth slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="https://www.economiafamiliar.gob.ni/websitemefcca-mvc/vistas/img/bioclima/05.jpg" alt="Fifth slide">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- Seccion de video EXPOPYME 2021 -->
<!-- <section id="videosSinPaginar" class="seccion seccion_expo">
    <div class="contenedor">
        <div class="centrar_boton_seccion">
            <div>
                <a href="https://www.economiafamiliar.gob.ni/websitemefcca-mvc/expo" class="boton btn_borde_blanco">EXPOPYME <i class="fas fa-arrow-right icono_boton"></i></a>
            </div>

            <form class="caja_buscar" action="<?php echo $ruta; ?>videos/" method="post" id="formBuscarVideoExpo">
                <input id="buscarVideoInicioExpo" class="texto_buscar" name="buscadorVideosInicio" type="search" placeholder="Buscar Videos">
                <a onclick="javascript:document.getElementById('formBuscarVideoExpo').submit();" class="btn_buscar"><i class="fas fa-search" aria-hidden="true"></i></a>
            </form>

        </div>
        <div class="contenedor_videos clearfix row">
            <div class="link-expo col-12">
                <video class="video-expo" src="https://www.economiafamiliar.gob.ni/websitemefcca-mvc/vistas/img/final.mp4" autoplay muted loop>Video</video>
            </div>
        </div>
    </div>
</section> -->

<section id="videosSinPaginar" class="seccion seccion_videos videoYoutube">
    <div class="contenedor">
        <div class="centrar_boton_seccion">
            <div>
                <a href="<?php echo $ruta; ?>videos/" class="boton btn_borde_blanco">Videos <i class="fas fa-arrow-right icono_boton"></i></a>
            </div>

            <form class="caja_buscar" action="<?php echo $ruta; ?>videos/" method="post" id="formBuscarVideo">
                <input id="buscarVideoInicio" class="texto_buscar" name="buscadorVideosInicio" type="search" placeholder="Buscar Videos">
                <a onclick="javascript:document.getElementById('formBuscarVideo').submit();" class="btn_buscar"><i class="fas fa-search" aria-hidden="true"></i></a>
            </form>

        </div>
        <div class="contenedor_videos clearfix">
            <div class="video principal">
                <img class="imagen_youtube" src=""></img>
                <div class="contenido_video">
                    <h2 class="limitar_tres_lineas"><?php echo $videosInicio[0]['titulo_video']; ?></h2>
                    <div class="opciones_video">
                        <p><i srcUrl="<?php echo $videosInicio[0]['link_video']; ?>" class="far fa-clock tiempoDuracion" aria-hidden="true"></i></p>
                        <a id="saul" href="#videostory1" class="videoLink"><i class="fas fa-play" aria-hidden="true"></i></a>
                        <div id="videostory1" class="mfp-hide" style="max-width: 75%; margin: 0 auto">
                            <div class="iframe-container">
                                <!-- 1. The <iframe> (and video player) will replace this <div> tag. -->
                                <div srcUrl="<?php echo $videosInicio[0]['link_video']; ?>" class="youtubeFrame" id="player1"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <ul class="lista_personalizada sidebar_videos">
                <li class="video">
                    <img class="imagen_youtube" src=""></img>
                    <div class="contenido_video">
                        <h2 class="limitar_tres_lineas"><?php echo $videosInicio[1]['titulo_video']; ?></h2>
                        <div class="opciones_video">
                            <p><i srcUrl="<?php echo $videosInicio[1]['link_video']; ?>" class="far fa-clock tiempoDuracion" aria-hidden="true"></i></p>
                            <a href="#videostory2" class="videoLink"><i class="fas fa-play" aria-hidden="true"></i></a>
                            <div id="videostory2" class="mfp-hide" style="max-width: 75%; margin: 0 auto">
                                <div class="iframe-container">
                                    <!-- 1. The <iframe> (and video player) will replace this <div> tag. -->
                                    <div srcUrl="<?php echo $videosInicio[1]['link_video']; ?>" class="youtubeFrame" id="player2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="video">
                    <img class="imagen_youtube" src=""></img>
                    <div class="contenido_video">
                        <h2 class="limitar_tres_lineas"><?php echo $videosInicio[2]['titulo_video']; ?></h2>
                        <div class="opciones_video">
                            <p><i srcUrl="<?php echo $videosInicio[2]['link_video']; ?>" class="far fa-clock tiempoDuracion" aria-hidden="true"></i></p>
                            <a href="#videostory3" class="videoLink"><i class="fas fa-play" aria-hidden="true"></i></a>
                            <div id="videostory3" class="mfp-hide" style="max-width: 75%; margin: 0 auto">
                                <div class="iframe-container">
                                    <!-- 1. The <iframe> (and video player) will replace this <div> tag. -->
                                    <div srcUrl="<?php echo $videosInicio[2]['link_video']; ?>" class="youtubeFrame" id="player3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</section>

<!-- Seccion Mapas Interactivos -->
<section id="MapasInteractivos" class="seccion seccion_documentos paginacion" style="text-align : center">
    <div class="container" style="text-align : center">

        <div class="row">

            <div class="col-xl-4 col-md-6 col-lg-4 col-sm-12 text-center align-items-center justify-content-center" style="width:400px;height: 400px;">
            <!-- <div style="text-align : center;width:33%" > -->
                
                <a class="img-fluid rounded-circle" href="http://mapaviveros.economiafamiliar.gob.ni/" target="__blank">
                    <img src="https://www.economiafamiliar.gob.ni/websitemefcca-mvc/vistas/img/mapas/vivero.png" class="img-fluid rounded-circle" alt="Mapa_Agricultura" style="width:300px;height: 250px;">
                </a>
                
                <a target="__blank" href="http://mapaviveros.economiafamiliar.gob.ni/" class="boton btn_borde_blanco m-4"></i>Mapa Interactivo de Emprendimientos, Jardines y Viveros<i class="fas fa-arrow-center icono_boton"></i></a>
            </div>

            <div class="col-xl-4 col-md-6 col-lg-4 col-sm-12 text-center align-items-center justify-content-center" style="width:400px;height: 400px;">
            <!-- <div style="text-align : center;width:33%" > -->

                <a  href="http://mapaagricultura.economiafamiliar.gob.ni/" target="__blank">
                    <img src="https://www.economiafamiliar.gob.ni/websitemefcca-mvc/vistas/img/mapas/MapaAgricultura.jpg" class="img-fluid rounded-circle"  alt="Mapa_Agricultura" style="width:300px;height: 250px;">
                </a>
                <a target="__blank" href="http://mapaagricultura.economiafamiliar.gob.ni/" class="boton btn_borde_blanco m-4"></i>Mapa Interactivo de la Agricultura Familiar<i class="fas fa-arrow-center icono_boton"></i></a>
            </div>

            <div class="col-xl-4 col-md-6 col-lg-4 col-sm-12 text-center align-items-center" style="width:400px;height: 400px;">
            <!-- <div style="text-align : center;width:33%"> -->
                <a  href="https://www.google.com/maps/d/embed?mid=1-XkFFV1dEriNHAyNSAIPHr1iL9_siM4&ehbc=2E312F&ll=12.58538993588257%2C-85.28711596847735&z=8" target="__blank">
                    <img src="https://www.economiafamiliar.gob.ni/websitemefcca-mvc/vistas/img/mapas/Mapa_Vinos.jpg" class="img-fluid rounded-circle" alt="Mapa_Vinos" style="width:300px;height: 250px;">
                </a>
                <a target="__blank" href="https://www.google.com/maps/d/embed?mid=1-XkFFV1dEriNHAyNSAIPHr1iL9_siM4&ehbc=2E312F&ll=12.58538993588257%2C-85.28711596847735&z=8" class="boton btn_borde_blanco m-4"></i>Mapa Protagonistas Procesadores de Vinos <i class="fas fa-arrow-center icono_boton"></i></a>
            </div>
            



        </div>

        <div class="row">

            <div class="col-xl-6 col-md-6 col-lg-6 col-sm-12 text-center align-items-center" style="width:400px;height: 400px;">
                <!-- <div style="text-align : center;width:33%"> -->
                <a href="https://www.google.com/maps/d/edit?mid=1rT5txlmckpL1CZLGwdezRUzLgcvJ0bo&ll=12.516968133975535%2C-85.3372165&z=7" target="__blank">
                    <img src="https://www.economiafamiliar.gob.ni/websitemefcca-mvc/vistas/img/mapas/Mapa_RutaCalidad.jpg" class="img-fluid rounded-circle" alt="Mapa_RutasCalidad" style="width:300px;height: 250px;">
                </a>
                <a target="__blank" href="https://www.google.com/maps/d/edit?mid=1rT5txlmckpL1CZLGwdezRUzLgcvJ0bo&ll=12.516968133975535%2C-85.3372165&z=7"  class="boton btn_borde_blanco m-4"></i>Mapa Ruta de la Calidad 2022 <i class="fas fa-arrow-center icono_boton"></i></a>
            </div>

            <div class="col-xl-6 col-md-6 col-lg-6 col-sm-12 text-center align-items-center justify-content-center" style="width:400px;height: 400px;">
            <!-- <div style="text-align : center;width:33%" > -->
                <a href="http://mapaapicultura.economiafamiliar.gob.ni/" target="__blank">
                    <img src="https://www.economiafamiliar.gob.ni/websitemefcca-mvc/vistas/img/mapas/MapaApicultura.jpg" class="img-fluid rounded-circle" alt="Mapa_Agricultura" style="width:300px;height: 250px;">
                </a>
                <a target="__blank" href="http://mapaapicultura.economiafamiliar.gob.ni/" class="boton btn_borde_blanco m-4"></i>Mapa Interactivo de la Apicultura<i class="fas fa-arrow-center icono_boton"></i></a>
            </div>


        </div>
    </div>
</section>



<form action='/websitemefcca-mvc/controladores/buzon.controlador.php' method="post" id="formulario-buzon">
    <section class="seccion seccion_buzon contenedor">
        <div class="centrar_boton_seccion">
            <button id="buzonContent" type="button" class="boton btn_estilo_uno">Buzón de Sugerencias</button>
        </div>
        <div id="buzon" class="contenedor_buzon clearfix">
            <div class="icono_buzon">
                <i class="fas fa-comment-dots" aria-hidden="true"></i>
            </div>
            <div class="buzon_datos_generales">
                <input type="text" id="nombre_buzon" placeholder="Nombre" name="nombre_buzon" id="nombre_buzon">
                <input type="email" id="mail_buzon" placeholder="Correo" name="mail_buzon" id="mail_buzon">
                <input type="text" id="asunto_buzon" placeholder="Asunto" name="asunto_buzon" id="asunto_buzon" required>
            </div>
            <div class="buzon_mensaje">
                <textarea id="mensaje_buzon" placeholder="Mensaje" name="mensaje_buzon" id="mensaje_buzon"></textarea>
                <div class="boton_buzon" id="btnCorreo">
                    <i class="fas fa-chevron-right imgBuzon" aria-hidden="true"></i>
                    <input type="submit" id="btnBuzon" value="">
                </div>
            </div>
        </div>

        <div class="lds-dual-ring"></div>
    </section>
</form>


<?php include "modulos/footer.php"; ?>

