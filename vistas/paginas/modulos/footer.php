<?php
$paginaEnTrabajo = true;
?>

<footer>
    <div class="footer_sitio contenedor clearfix">
        <nav class="menu">
            <ul class="lista_personalizada">
                <li class="li_encabezado"><a class="hh">Menu<i class="float_right fas fa-angle-down" aria-hidden="true"></i></a>
                    <ul class="lista_personalizada">
                        <li><a href="<?php echo $ruta; ?>index.php">Inicio</a></li>
                        <li><a href="<?php echo $ruta; ?>juridico">Marco Jurídico</a></li>
                        <li><a href="<?php echo $ruta; ?>mision">Misión y Visión</a></li>
                        <li><a href="<?php echo $ruta; ?>notimefcca">NotiMefcca</a></li>
                        <li><a href="<?php echo $ruta; ?>documentos/">Documentos</a></li>
                        <li><a href="<?php echo $ruta; ?>videos/">Videos</a></li>
                        <li><a href="<?php echo $ruta; ?>documentos/Boletin">Boletines Informativos</a></li>
                        <li><a href="<?php echo $ruta; ?>delegaciones">Delegaciones</a></li>
			<li><a href="https://www.economiafamiliar.gob.ni/backend/vistas/doc/documentos/documento4779326.pdf">Código de Conducta</a></li>
			<li><a href="https://www.economiafamiliar.gob.ni/backend/vistas/doc/documentos/documento1795365.pdf">Organigrama MEFCCA 2022</a></li>

                    </ul>
                </li>
                <li class="li_encabezado"><a class="hh">Direcciones<i class="float_right fas fa-angle-down" aria-hidden="true"></i></a>
                    <ul class="lista_personalizada">
                        <?php foreach ($direccion as $key => $valueDireccion) : ?>
                            <?php $urlDireccion = ControladorUrlAmigable::ctrUrlAmigable($valueDireccion['titulo']); ?>
                            <?php $idDireccion = $valueDireccion['id']; ?>
                            <li><a data-pushbar-close href="<?php echo $ruta; ?>direccion/<?php echo $urlDireccion; ?>/<?php echo $idDireccion; ?>"><?php echo $valueDireccion['titulo']; ?></a>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </li>
                <li class="tercero">
                    <div>
                        <ul class="lista_personalizada">
                            <li class="li_encabezado"><a class="hh">Proyectos<i class="float_right fas fa-angle-down" aria-hidden="true"></i></a>
                                <ul class="lista_personalizada">
                                    <?php foreach ($proyecto as $key => $valueProyecto) : ?>
                                        <?php $urlProyecto = ControladorUrlAmigable::ctrUrlAmigable($valueProyecto['titulo']); ?>
                                        <?php $idProyecto = $valueProyecto['id']; ?>
                                        <li><a data-pushbar-close href="<?php echo $ruta; ?>proyecto/<?php echo $urlProyecto; ?>/<?php echo $idProyecto; ?>"><?php echo $valueProyecto['titulo']; ?></a>
                                        </li>
                                    <?php endforeach ?>
                                </ul>
                            </li>
                            <li class="li_encabezado"><a class="hh">Entes <br> Descentralizados<i class="float_right fas fa-angle-down" aria-hidden="true"></i></a>
                                <ul class="lista_personalizada">
                                    <?php foreach ($programa as $key => $valuePrograma) : ?>
                                        <?php $urlPrograma = ControladorUrlAmigable::ctrUrlAmigable($valuePrograma['titulo']); ?>
                                        <?php $idPrograma = $valuePrograma['id']; ?>
                                        <li><a data-pushbar-close href="<?php echo $ruta; ?>entesDescentralizados/<?php echo $urlPrograma; ?>/<?php echo $idPrograma; ?>"><?php echo $valuePrograma['titulo']; ?></a>
                                        </li>
                                    <?php endforeach ?>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="cuarto">
                    <div>
                        <ul class="lista_personalizada">
                            <li class="li_encabezado"><a href="<?php echo $ruta; ?>programas">Programas Emblemáticos</a>
                            </li>
                            <li class="li_encabezado"><a>Enlaces Web<i class="float_right fas fa-angle-down" aria-hidden="true"></i></a>
                                <ul class="lista_personalizada">
                                    <li><a data-pushbar-close href="https://pn.economiafamiliar.gob.ni/" target="_blank">Pequeños Negocios</a></li>
                                    <li><a data-pushbar-close href="https://mail.economiafamiliar.gob.ni/" target="_blank">Correo Institucional</a></li>
                                </ul>
                            </li>
                            <li class="li_encabezado"><a>Servicios Asociatividad<i class="float_right fas fa-angle-down" aria-hidden="true"></i></a>
                                <ul class="lista_personalizada">
                                    <li><a data-pushbar-close href="http://asistentevirtual.economiafamiliar.gob.ni:8080/sim/index.html" target="_blank">Asistente Virtual</a></li>
                                    <li><a data-pushbar-close href="https://sim.economiafamiliar.gob.ni/sim/" target="_blank">Servicios en Línea</a></li>
                                </ul>
                            </li>

                            <li class="li_encabezado"><a href="<?php echo $ruta; ?>documentos/Convocatoria">Convocatorias</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <h3>Redes Sociales</h3>
                    <nav class="redes_sociales rs_footer">
                        <a href="https://es-la.facebook.com/ministeriodeeconomiafamiliar/" target="_blank" class="facebook"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
                        <a href="https://www.instagram.com/mefcca_nic/?hl=es-la" target="_blank" class="instagram"><i class="fab fa-instagram" aria-hidden="true"></i></a>
                        <a href="https://twitter.com/MEFCCANic?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor" target="_blank" class="twitter"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                        <a href="https://www.youtube.com/channel/UCMHl3nIh_inJS_HhV2FCLNQ" target="_blank" class="youtube"><i class="fab fa-youtube"></i></a>

                    </nav>
                </li>
                <li>
                    <h3>Contactos</h3>
                    <p><i class="fas fa-phone-alt" aria-hidden="true"></i> 2298-0240</p>
                    <p><i class="fas fa-map-marker-alt" aria-hidden="true"></i> Km 8.5 carretera a Masaya, frente al
                        MAG,
                        Managua, Nicaragua</p>
                </li>
            </ul>
        </nav>
        <div class="footer_logos">
            <div class="primer_grupo_logos">
                <img src="img/Logo_Gobierno_Gris.svg" alt="Logo Gob">
                <img src="img/Logo_Mefcca_Gris.svg" alt="Logo Mef">
                <img src="img/Logo_Mific_Gris.svg" alt="Logo Mif">
                <img src="img/Logo_Inatec_Gris.svg" alt="Logo Ina">
                <img src="img/Logo_Marena_Gris.svg" alt="Logo Mar">
                <img src="img/Logo_Inta_Gris.svg" alt="Logo Inta">
            </div>
            <div class="segundo_grupo_logos">
                <img src="img/Logo_Ipsa_Gris.svg" alt="Logo Ipsa">
                <img src="img/Logo_Inafor_Gris.svg" alt="Logo Inafor">
                <img src="img/Logo_Magfor_Gris.svg" alt="Logo Mag">
                <img src="img/Logo_Conatradenic_Gris.svg" alt="Logo Cona">
            </div>
        </div>
        <div class="copyright">
            <p>"Esperanzas Victoriosas, Todo Con Amor"</p>
            <p>&copy Ministerio de Economía Familiar</p>
        </div>
    </div>
</footer>

<div class="contenedor_boton_ir_arriba">
    <div class="btn_ir_arriba">
        <i class="fas fa-chevron-up" aria-hidden="true"></i>
    </div>
</div>
