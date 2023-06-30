<?php
    include 'modulos/header.php';

    $id = explode("/", $_GET['pagina']);
    $id_position = sizeof($id) - 1;
    $programaEstu = ControladorEstructura::ctrMostrarEstructura($id[$id_position]);
    $videosInicio = ControladorVideosInicio::ctrMostrarVideosSideBar($id[$id_position]);
    $documentosSideBar = ControladorDocumentosSideBar::ctrMostrarDocumentosSideBar($id[$id_position]);
?>

<main id="videosSinPaginar" class="seccion_direccion seccion contenedor videoYoutube">
    <div class="centrar_boton_seccion padding_boton_seccion">
        <div>
            <a href="<?php echo $ruta; ?>" class="boton btn_estilo_uno"><i class="fas fa-arrow-left icono_boton"></i>
                Inicio</a>
        </div>
    </div>

    <div class="encabezado_direccion">
        <h2><?php echo $programaEstu[0]['titulo'];?></h2>
    </div>

    <div class="contenedor_direccion clearfix">
        <div class="direccion_principal">
            <div class="imagen_destacada">
                <img src="<?php echo $servidor . $programaEstu[0]['imagen'];?>" alt="Imagen Direccion">
            </div>
            <div class="texto"><?php echo $programaEstu[0]['descripcion'];?></div>
            
            <?php if($programaEstu[0]['titulo'] == 'Administración Nacional de Ferias'){ ?>

                <section class="seccion_direccion seccion contenedor">
                    <div class="anfef">
                        <a href="https://www.facebook.com/casonanicaragua01/" target="_blank">
                            <img src="img/casona_cafe.jpg" alt="Casona del cafe">
                        </a>
                    </div>

                    <div class="anfef">
                        <a href="https://www.facebook.com/lacasadelmaiz01/" target="_blank">
                            <img src="img/casa_maiz.jpg" alt="Casa del Maiz">
                        </a>
                    </div>

                    <div class="anfef">
                        <a href="https://www.facebook.com/Sorbeter%C3%ADa-La-Hormiga-de-Oro-319794745330233/" target="_blank">
                            <img src="img/hormiga.jpg" alt="Hormiga de Oro">
                        </a>
                    </div>
                    
                </section>

            <?php } ?>
        </div>

        <div class="sidebar_direcciones">

            <?php if( sizeof($videosInicio) != 0 ){ ?>
            <div class="centrar_boton_seccion padding_boton_seccion">
                <div>
                    <a href="videos.php" class="boton btn_estilo_uno">Videos <i
                            class="fas fa-arrow-right icono_boton"></i></a>
                </div>
            </div>
            <?php } ?>

            <div class="contenedor_videos clearfix">

                <?php $i = 1; ?>
                <?php foreach ($videosInicio as $key => $data) : ?>
                <?php $videoStory = 'videostory' . ($i++); ?>

                <div class="video">
                    <img class="imagen_youtube" src=""></img>
                    <div class="contenido_video">
                        <h2 class="limitar_tres_lineas"><?php echo $data['titulo_video']; ?></h2>
                        <div class="opciones_video">
                            <p><i srcUrl="<?php echo $data['link_video']; ?>" class="far fa-clock tiempoDuracion"
                                    aria-hidden="true"></i></p>
                            <a href="#<?php echo $videoStory; ?>" class="videoLink"><i class="fas fa-play"
                                    aria-hidden="true"></i></a>
                            <div id="<?php echo $videoStory; ?>" class="mfp-hide"
                                style="max-width: 75%; margin: 0 auto">
                                <div class="iframe-container">
                                    <div srcUrl="<?php echo $data['link_video']; ?>" class="youtubeFrame"
                                        id="player<?php echo $i; ?>"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php endforeach ?>

            </div>

            <?php if( sizeof($documentosSideBar) != 0 ){ ?>
                <div class="centrar_boton_seccion padding_boton_seccion">
                    <div>
                        <a href="<?php echo $ruta; ?>documentos/<?php echo $id[$id_position] ?>" 
                            class="boton btn_estilo_uno">Documentos <i class="fas fa-arrow-right icono_boton"></i></a>
                    </div>
                </div>
            <?php } ?>

            <div class="contenedor_documentos clearfix">

                <?php foreach ($documentosSideBar as $key => $data) : ?>

                <div class="documento">
                    <a href="<?php echo $servidor . $data['archivo'] ?>" target="_blank">
                        <img src="<?php echo $servidor . $data['imagen_documento'] ?>"
                            alt="<?php $data['titulo_documento'] ?>">
                        <div class="contenido_documento">
                            <h2 class="limitar_tres_lineas"><?php echo $data['titulo_documento'] ?></h2>
                            <p class="limitar_dos_lineas"><?php echo $data['descrip_documento'] ?></p>
                        </div>
                    </a>
                </div>

                <?php endforeach ?>

            </div>

            <?php if( (sizeof($videosInicio) == 0) && (sizeof($documentosSideBar) == 0) ){
                $noticia = "noticia-";
                $pleca = "/";
                $noticiaSidebar = ControladorNoticiasSidebar::ctrNoticiasSideBarTopDos(); ?>

            <div class="centrar_boton_seccion padding_boton_seccion">
                <a href="<?php echo $ruta; ?>notimefcca" class="boton btn_estilo_uno">NotiMefcca<i
                        class="fas fa-arrow-right icono_boton"></i></a>
            </div>

            <div class="sidebar_noticias">
                <?php foreach ($noticiaSidebar as $key => $valueSidebar) : ?>
                <?php $url = ControladorUrlAmigable::ctrUrlAmigable($valueSidebar['titulo']); ?>
                <?php $id = $valueSidebar['id']; ?>
                <div class="noticia">
                    <img src="<?php echo $servidor . $valueSidebar['imagen_noticia']; ?>" alt="Imagen Noticia 1">
                    <div class="contenido_noticia">
                        <div class="encabezado_noticia">
                            <h2 class="limitar_tres_lineas"><?php echo $valueSidebar['titulo']; ?></h2>
                            <div class="lista_detalle_noticia">
                                <p><i class="far fa-calendar" aria-hidden="true"></i>
                                    <span><?php echo $valueSidebar['fecha']; ?></span>
                                </p>
                                <p><i class="far fa-clock" aria-hidden="true"></i>
                                    <span><?php echo $valueSidebar['hora']; ?></span>
                                </p>
                                <p><i class="far fa-user" aria-hidden="true"></i>
                                    <span><?php echo $valueSidebar['nombre_completo'] ?></span>
                                </p>
                            </div>
                        </div>
                        <p class="limitar_dos_lineas"><?php echo $valueSidebar['descripcion_corta']; ?></p>
                        <div class="pie_noticia">
                            <nav class="redes_sociales">
                                <a href="<?php echo $valueSidebar['facebook']; ?>" target="_blank" class="facebook"><i
                                        class="fab fa-facebook-f" aria-hidden="true"></i></a>
                                <a href="<?php echo $valueSidebar['instagram']; ?>" target="_blank" class="instagram"><i
                                        class="fab fa-instagram" aria-hidden="true"></i></a>
                                <a href="<?php echo $valueSidebar['twitter']; ?>" target="_blank" class="twitter"><i
                                        class="fab fa-twitter" aria-hidden="true"></i></a>
                            </nav>
                            <a href="<?php echo $ruta . $noticia . $url . $pleca . $id; ?>"
                                class="boton btn_estilo_dos">Ver más <i
                                    class="fas fa-arrow-right icono_arrow icono_boton"></i></a>
                        </div>
                    </div>
                </div>
                <?php endforeach ?>
            </div>

            <?php } ?>

        </div>
    </div>
</main>

<script>
document.title = '<?php echo $programaEstu[0]['titulo']; ?>';
</script>

<?php
    include 'modulos/footer.php';
?>