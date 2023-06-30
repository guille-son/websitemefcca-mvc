<?php
    include 'modulos/header.php';
?>

<main id="paginacion" class="seccion contenedor paginacion">
    <div class="centrar_boton_seccion padding_boton_seccion">
        <div>
            <a href="<?php echo $ruta; ?>" class="boton btn_estilo_uno"><i class="fas fa-arrow-left icono_boton"></i> Inicio</a>
        </div>
        <div id="cajaBusqueda" class="caja_buscar caja_estilo_dos">
            <input id="txtBusqueda" class="texto_buscar" type="search" placeholder="Buscar Noticias">
            <i id="cancelarBusqueda" class="cancelNormal cancelSearch far fa-times-circle"></i>
            <a id="btnBuscar" class="btn_buscar"><i class="fas fa-search" aria-hidden="true"></i></a>
        </div>
    </div>

    <div id="programasEmblematicos" class="paginacionContent">
        <ul id="listPage" class="lista_personalizada contenedor_notimefcca clearfix my-shuffle-container"></ul>
        
        <div class="holderContent">
            <div id="holder" class="holder ocultarItem"></div>
        </div>
    </div>

</main>

<script>
document.title = 'Programas Emblematicos';
</script>

<?php
    include 'modulos/footer.php';
?>