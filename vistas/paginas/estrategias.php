<?php
    include 'modulos/header.php';
    $id = explode("/", $_GET['pagina']);
    $id_position = sizeof($id) - 1;

    if($id[$id_position] != ''){ ?>
        <div id="filtroEstructura" estructura="<?php echo $id[$id_position] ?>"></div>
    <?php }
?>

<main id="paginacion" class="seccion contenedor paginacion">
    <div class="centrar_boton_seccion padding_boton_seccion">
        <div>
            <a href="<?php echo $ruta; ?>programas" class="boton btn_estilo_uno"><i class="fas fa-arrow-left icono_boton"></i> Programas Emblemáticos</a>
        </div>
        <div id="cajaBusqueda" class="caja_buscar caja_estilo_dos">
            <input id="txtBusqueda" class="texto_buscar" type="search" placeholder="Buscar Noticias">
            <i id="cancelarBusqueda" class="cancelNormal cancelSearch far fa-times-circle"></i>
            <a id="btnBuscar" class="btn_buscar"><i class="fas fa-search" aria-hidden="true"></i></a>
        </div>
    </div>

    <div id="estrategias" class="paginacionContent">
        <ul id="listPage" class="lista_personalizada contenedor_notimefcca clearfix my-shuffle-container"></ul>
        
        <div class="holderContent">
            <div id="holder" class="holder ocultarItem"></div>
        </div>
    </div>

</main>

<script>
document.title = 'Estrategias';
</script>

<?php
    include 'modulos/footer.php';
?>