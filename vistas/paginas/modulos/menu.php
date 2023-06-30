
<?php
$direccion = ControladorEstructura::ctrCargarTitulosEstructura(21);
$proyecto = ControladorEstructura::ctrCargarTitulosEstructura(28);
$programa = ControladorEstructura::ctrCargarTitulosEstructura(80);
$radioInicio = ControladorRadio::ctrMostrarRadio();
$dir = "direccion-";
$pro = "proyecto-";
$progra = "programa-";
$pleca = "/";

$paginaEnTrabajo = true;
?>

<div data-pushbar-id="pushbar_menu" class="pushbar" data-pushbar-direction="top">
    <div class="menu_sitio contenedor clearfix">
        <div class="centrar_boton_seccion botones_menu">
            <div>
                <a data-pushbar-close class="btn_cerrar_menu"><i class="fas fa-times" aria-hidden="true"></i></a>
            </div>

            <?php if (!$paginaEnTrabajo) { ?>
                <div class="caja_buscar">
                    <input class="texto_buscar" type="search" placeholder="Buscar">
                    <a href="" class="btn_buscar"><i class="fas fa-search" aria-hidden="true"></i></a>
                </div>
            <?php } ?>

        </div>
        <nav class="header_menu menu">
            <ul class="lista_personalizada">
                <li class="primero li_encabezado"><a>Menú<i class="float_right fas fa-angle-down" aria-hidden="true"></i></a>
                    <ul class="lista_personalizada">
                        <li><a data-pushbar-close href="<?php echo $ruta; ?>">Inicio</a></li>
                        <li><a data-pushbar-close href="<?php echo $ruta; ?>juridico">Marco Jurídico</a></li>
                        <li><a data-pushbar-close href="<?php echo $ruta; ?>mision">Misión y Visión</a></li>
                        <li><a data-pushbar-close href="<?php echo $ruta; ?>notimefcca">NotiMefcca</a></li>
                        <li><a data-pushbar-close href="<?php echo $ruta; ?>documentos/">Documentos</a></li>
                        <li><a data-pushbar-close href="<?php echo $ruta; ?>videos/">Videos</a></li>
                        <li><a data-pushbar-close href="<?php echo $ruta; ?>documentos/Boletin">Boletines Informativos</a></li>
                        <li><a data-pushbar-close href="<?php echo $ruta; ?>delegaciones">Delegaciones</a></li>
			<li><a data-pushbar-close href="<?php echo $ruta; ?>adelante">Programa Adelante</a></li>
                        <!-- <li><a data-pushbar-close href="http://mapamicrocredito.economiafamiliar.gob.ni/" target="_blank">Mapa de Protagonistas McriCreditos</a></li> -->
                        <li><a data-pushbar-close href="http://mapaagricultura.economiafamiliar.gob.ni/" target="_blank">Mapa de Protagonistas Agricultura</a></li>
                        <li><a data-pushbar-close href="http://mapaviveros.economiafamiliar.gob.ni/" target="_blank">Mapa Interactivo de Emprendimientos, Jardínes y Viveros</a></li>
                        <li><a data-pushbar-close href="https://www.google.com/maps/d/embed?mid=1-XkFFV1dEriNHAyNSAIPHr1iL9_siM4&ehbc=2E312F" target="_blank">Mapa Interactivo Protagonistas Procesadores De Vinos Artesanales Nicaraguenses</a></li>
                        <li><a data-pushbar-close href="https://www.google.com/maps/d/edit?mid=1rT5txlmckpL1CZLGwdezRUzLgcvJ0bo&usp=sharing" target="_blank">Mapa Interactivo Ruta de la Calidad 2022</a></li>

                    </ul>
                </li>
                <li class="segundo li_encabezado"><a>Direcciones<i class="float_right fas fa-angle-down" aria-hidden="true"></i></a>
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
                            <li class="li_encabezado"><a>Proyectos<i class="float_right fas fa-angle-down" aria-hidden="true"></i></a>
                                <ul class="lista_personalizada">
                                    <?php foreach ($proyecto as $key => $valueProyecto) : ?>
                                        <?php $urlProyecto = ControladorUrlAmigable::ctrUrlAmigable($valueProyecto['titulo']); ?>
                                        <?php $idProyecto = $valueProyecto['id']; ?>
                                        <li><a data-pushbar-close href="<?php echo $ruta; ?>proyecto/<?php echo $urlProyecto; ?>/<?php echo $idProyecto; ?>"><?php echo $valueProyecto['titulo']; ?></a>
                                        </li>
                                    <?php endforeach ?>
                                </ul>
                            </li>
                            <li class="li_encabezado"><a>Entes <br> Descentralizados<i class="float_right fas fa-angle-down" aria-hidden="true"></i></a>
                                <ul class="lista_personalizada">
                                    <?php foreach ($programa as $key => $valuePrograma) : ?>
                                        <?php $urlPrograma = ControladorUrlAmigable::ctrUrlAmigable($valuePrograma['titulo']); ?>
                                        <?php $idPrograma = $valuePrograma['id']; ?>
                                        <li><a data-pushbar-close href="<?php echo $ruta; ?>entesDescentralizados/<?php echo $urlPrograma; ?>/<?php echo $idPrograma; ?>"><?php echo $valuePrograma['titulo']; ?></a>
                                        </li>
                                    <?php endforeach ?>
                                </ul>
                            </li>

                            <li class="li_encabezado"><a>Plataformas<i class="float_right fas fa-angle-down" aria-hidden="true"></i></a>
                                <ul class="lista_personalizada">
                                    <li>
                                        <a href="<?php echo $ruta; ?>fuerzabendita">Nicaragua Fuerza Bendita</a>
                                    </li>

                                    <li>
                                        <a href="<?php echo $ruta; ?>expo">- EXPOPYME 2021</a>
                                    </li>

                                    <li>
                                        <a href="<?php echo $ruta; ?>expo22">- EXPOPYME 2022</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $ruta; ?>expo23">- EXPOPYME 2023</a>
                                    </li>
				    <li>
                                        <a href="https://www.economiafamiliar.gob.ni/backend/vistas/doc/boletain/documento3202155.pdf" target="_blank">- Catálogo EXPOPYME 2021</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">- Nicaragua Emprende</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $ruta; ?>rutacreativa" class="ml-4"> <span class="font-weight-bolder"> > </span> Ruta Creativa Emprendedora</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $ruta; ?>inscripciones" class="ml-4"> <span class="font-weight-bolder"> > </span> Inscripciones IV Expo Anual 2021</a>
                                    </li>
                                    <li>
                                        <a href="#!" class="ml-4 d-none"> <span class="font-weight-bolder"> > </span> Agendas IV Expo Anual 2021</a>
                                    </li>
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
				    <li><a data-pushbar-close href="http://www.marena.gob.ni/Enderedd/proyectobioclima/" target="_blank">Proyecto BioClima</a></li>
                                    <li><a data-pushbar-close href="https://pn.economiafamiliar.gob.ni/" target="_blank">Pequeños Negocios</a></li>
                                    <li><a data-pushbar-close href="<?php echo $ruta; ?>flores" target="_blank">Primer Carnaval de las Flores</a></li>
                                    <li><a data-pushbar-close href="https://pn.economiafamiliar.gob.ni/primer-concurso-regional-y-nacional-de-elaboracion-de-logo-y-marcas-piensa-crea-y-disena/" target="_blank">Concurso de Logo y Marca</a></li>
				    <li><a data-pushbar-close href="https://pn.economiafamiliar.gob.ni/ii-concurso-nacional-de-elaboracion-de-marcas-impulsando-tu-exito-comercial/" target="_blank">II Concurso Nacional de Elaboración de Marcas</a></li>
				    <li><a data-pushbar-close href="https://pn.economiafamiliar.gob.ni/ministerio-de-economia-familiar-comunitaria-cooperativa-y-asociativa/" target="_blank">III Edición de Eco Emprendedores</a></li>
                                    <li><a data-pushbar-close href="<?php echo $ruta; ?>cdigitales" target="_blank">III Concurso Mejor Campaña Publicidad Digital</a></li>
                                    <li><a data-pushbar-close href="<?php echo $ruta; ?>agronegocios" target="_blank">III Concurso Nacional de Agronegocios</a></li>
                                    <li><a data-pushbar-close href="<?php echo $ruta; ?>artesanias" target="_blank">V Concurso de Diseño e Innovación de Artesanías de bambú</a></li>
                                    <li><a data-pushbar-close href="<?php echo $ruta; ?>eco-madera" target="_blank">Concurso eco-madera en tiempos de Victorias</a></li>
				    <li><a data-pushbar-close href="<?php echo $ruta; ?>expometal" target="_blank">Concurso “METALIZA2, un avance Tecnológico”</a></li>
                                    <li><a data-pushbar-close href="<?php echo $ruta; ?>acompanamientoDGAVC" target="_blank">Acompañamientos Técnicos Agroindustriales</a></li>
                                    <li><a data-pushbar-close href="https://pn.economiafamiliar.gob.ni/ii-concurso-nacional-de-jugueteria-tradicional/" target="_blank">II Concurso Nacional de Juguetería Tradicional</a></li>
                                    <!-- <li><a data-pushbar-close href="https://pn.economiafamiliar.gob.ni/Catalogo_Juguetes_Dic_2021/" target="_blank">Catálogo de Juguetes Diciembre 2021</a></li> -->
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
                            <!--  <li class="li_encabezado"><a href="<?php echo $ruta; ?>expo">EXPOPYME 2021 </a></li> -->

                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</div>

<div data-pushbar-id="pushbar_menu_radio" class="pushbar_radio" data-pushbar-direction="top">
    <div class="menu_sitio contenedor clearfix">
        <div>
            <a data-pushbar-close class="btn_cerrar_menu"><i class="fas fa-times" aria-hidden="true"></i></a>
        </div>
        <div class="ivoox-container" id="myDiv">
            <h3 class="widget-title">Programas Radiales MEFCCA</h3>

            <audio id="audio" preload="auto" tabindex="0" controls="" autoplay="false">
                <source src="<?php echo $servidor . $radioInicioPrincipal[0]['linkPrograma']; ?>">
            </audio>

            <ul id="playlist">
                <?php foreach ($radioInicio as $key => $valueRadio) : ?>
                    <li class="active">
                        <i class="fas fa-play"></i>
                        <a href="<?php echo  $servidor . $valueRadio['linkPrograma']; ?>" autoplay="false">
                            <?php echo $valueRadio['tema']; ?>
                        </a>

                        <?php $fa = $valueRadio['fecha'];
                        $newDate = date("d-m-Y", strtotime($valueRadio['fecha']));
                        ?>

                        <h4 class="fechaPrograma"><?php echo '(' . $newDate . ')'; ?></h4>
                        <div class="mb-10px"></div>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>
    </div>

</div>


<script>
    init();

    function init() {
        var audio = document.getElementById('audio');
        var playlist = document.getElementById('playlist');
        var tracks = playlist.getElementsByTagName('a');
        audio.volume = 0.10;
        audio.play();

        for (var track in tracks) {
            var link = tracks[track];
            if (typeof link === "function" || typeof link === "number") continue;

            link.addEventListener('click', function(e) {
                e.preventDefault();
                var song = this.getAttribute('href');
                run(song, audio, this);
            });
        }

        audio.addEventListener('ended', function(e) {
            for (var track in tracks) {
                var link = tracks[track];
                var nextTrack = parseInt(track) + 1;
                if (typeof link === "function" || typeof link === "number") continue;
                if (!this.src) this.src = tracks[0];
                if (track == (tracks.length - 1)) nextTrack = 0;
                console.log(nextTrack);
                if (link.getAttribute('href') === this.src) {
                    var nextLink = tracks[nextTrack];
                    run(nextLink.getAttribute('href'), audio, nextLink);
                    break;
                }
            }
        });
    }

    function run(song, audio, link) {
        var parent = link.parentElement;

        //quitar el active de todos los elementos de la lista
        var items = parent.parentElement.getElementsByTagName('li');
        for (var item in items) {
            if (items[item].classList)
                items[item].classList.remove("active");
        }

        //agregar active a este elemento
        parent.classList.add("active");

        //tocar la cancion
        audio.src = song;
        audio.load();
        audio.play();
    }
</script>
