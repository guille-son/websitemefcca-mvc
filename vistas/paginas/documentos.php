<?php
    include 'modulos/header.php';

    $categorias = ControladorDocumentosSideBar::ctrCategoriasDocumentos();
    $id = explode("/", $_GET['pagina']);
    $id_position = sizeof($id) - 1;

    if($id[$id_position] != ''){ ?>
        <div id="filtroEstructura" estructura="<?php echo $id[$id_position] ?>"></div>
    <?php }
    
?>

<main id="paginacion" class="seccion contenedor paginacion">
    <div class="centrar_boton_seccion padding_boton_seccion">
        <div>
            <a href="<?php echo $ruta; ?>documentos/" class="boton btn_estilo_uno">Documentos <i
                    class="fas fa-arrow-right icono_boton"></i></a>
        </div>
        <div id="cajaBusqueda" class="caja_buscar caja_estilo_dos">
            <input id="txtBusqueda" class="texto_buscar" type="search" placeholder="Buscar Documentos">
            <i id="cancelarBusqueda" class="cancelNormal cancelSearch far fa-times-circle"></i>
            <a id="btnBuscar" class="btn_buscar"><i class="fas fa-search" aria-hidden="true"></i></a>
        </div>
    </div>

    <!-- Comprueba que no provenga de una pagina con filtro unico, como convocatorias, para poner los botones de filtro. -->
    <?php if($id[0] == 'documentos' && ( ($id[$id_position]=='')||(is_numeric($id[$id_position])) ) ){ ?>
        <div id="filtros" class="botonFiltro">

            <a class="boton filtroBusqueda filtroDesactivado filtroActivado">Todos</a>
            <?php foreach ($categorias as $key => $category) : ?>
            <a class="boton filtroBusqueda filtroDesactivado"><?php echo $category['desripcion'] ?></a>
            <?php endforeach ?>

        </div>
    <?php } ?>

    <div id="documentos" class="paginacionContent">
        <ul id="listPage" class="lista_personalizada contenedor_documentos clearfix  my-shuffle-container"></ul>

        <div class="holderContent">
            <div id="holder" class="holder ocultarItem"></div>
        </div>
    </div>
</main>

<?php if ( ($id[$id_position] == 'Boletin') ){ ?>
    <script>
    document.title = 'Boletin';
    </script>
<?php }else if( ($id[$id_position] == 'Convocatoria') ){ ?>
    <script>
    document.title = 'Convocatoria';
    </script>
<?php }else{ ?>
    <script>
    document.title = 'Documentos';
    </script>
<?php } ?>

<?php
    include 'modulos/footer.php';
?>