<?php
    include 'modulos/header.php';

    $categorias = ControladorVideosInicio::ctrCategoriasVideos();
    $id = explode("/", $_GET['pagina']);
    $id_position = sizeof($id) - 1;
    $busqueda = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['buscadorVideosInicio'])){
            $busqueda = $_POST['buscadorVideosInicio'];
        }
    }

    if($id[$id_position] != ''){ ?>
<div id="filtroEstructura" estructura="<?php echo $id[$id_position] ?>"></div>
<?php }

?>

<main id="paginacion" class="seccion contenedor paginacion videoYoutube">
    <div class="centrar_boton_seccion padding_boton_seccion">
        <div>
            <a href="<?php echo $ruta; ?>videos/" class="boton btn_estilo_uno">Videos <i
                    class="fas fa-arrow-right icono_boton"></i></a>
        </div>
        <div id="cajaBusqueda" class="caja_buscar caja_estilo_dos">
            <input id="txtBusqueda" class="texto_buscar" type="search" placeholder="Buscar Videos"
                value="<?php echo $busqueda ?>">
                <i id="cancelarBusqueda" class="cancelNormal cancelSearch far fa-times-circle"></i>
            <a id="btnBuscar" class="btn_buscar"><i class="fas fa-search" aria-hidden="true"></i></a>
        </div>
    </div>

    <div id="filtros" class="botonFiltro">

        <a class="boton filtroBusqueda filtroDesactivado filtroActivado">Todos</a>
        <?php foreach ($categorias as $key => $category) : ?>
        <a class="boton filtroBusqueda filtroDesactivado"><?php echo $category['desripcion'] ?></a>
        <?php endforeach ?>

    </div>

    <div id="videos_Paginacion" class="paginacionContent">
        <ul id="listPage" class="lista_personalizada contenedor_videos seccion_video clearfix  my-shuffle-container">
        </ul>

        <div class="holderContent">
            <div id="holder" class="holder ocultarItem"></div>
        </div>

    </div>
</main>

<script>
    document.title = 'Videos';
  </script>

<?php
    include 'modulos/footer.php';
  ?>