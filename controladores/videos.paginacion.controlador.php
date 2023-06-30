<?php
include "../modelos/videos.paginacion.modelo.php";

$tipo = $_POST['tipo'];
if($tipo == 'cargar_paginacion'){
    $pagina = $_POST['paginaActual'] - 1;
    $pageSize = $_POST['pageSize'];
    $filtro = $_POST['filtro'];
    $titulo = $_POST['titulo'];
    $estructura =  $_POST['estructura'];
    $estructFilter;

    if($estructura != 'Ninguna'){
        $estructFilter = 'AND vi.estructura_id = ' . $estructura;
    }else{
        $estructFilter = '';
    }

    if($filtro == 'Todos'){
        die(ControladorVideos::ctrMostrarVideos($pagina,$pageSize,$titulo,$estructFilter) );
    }else{
        die(ControladorVideos::ctrVideosFiltroCategoria($pagina,$pageSize,$filtro,$titulo,$estructFilter) );
    }

}

if($tipo == 'IdCount'){
    $filtro = $_POST['filtro'];
    $titulo = $_POST['titulo'];
    $estructura =  $_POST['estructura'];
    $estructFilter;

    if($estructura != 'Ninguna'){
        $estructFilter = 'AND vi.estructura_id = ' . $estructura;
    }else{
        $estructFilter = '';
    }

    if($filtro == 'Todos'){
        die(ControladorVideos::ctrTotalVideos($titulo,$estructFilter));
    }else{
        die(ControladorVideos::ctrTotalVideosFiltroCategoria($filtro,$titulo,$estructFilter) );
    }

}

Class ControladorVideos{
    /*====================================================
            PETICIONES PARA PAGINACION DE VIDEOS
    =====================================================*/

    /* Carga videos segun la pagina actual de la paginacion */
    static public function ctrMostrarVideos($pagina,$pageSize,$titulo,$estructFilter){
        $paginaVideos = ModeloPaginacionVideos::mdlMostrarVideos($pagina,$pageSize,$titulo,$estructFilter);
        return $paginaVideos;
    }

    static public function ctrTotalVideos($titulo,$estructFilter){
        $ids = ModeloPaginacionVideos::mdlVideosSinFiltros($titulo,$estructFilter);

        return $ids;
    }

    static public function ctrVideosFiltroCategoria($pagina,$pageSize,$filtro,$titulo,$estructFilter){
        $idSearch = ModeloPaginacionVideos::mdlVideosFiltroCategoria($pagina,$pageSize,$filtro,$titulo,$estructFilter);

        return $idSearch;
    }

    static public function ctrTotalVideosFiltroCategoria($filtro,$titulo,$estructFilter){
        $DocumentoPorTitulo = ModeloPaginacionVideos::mdlTotalVideosFiltradosCategoria($filtro,$titulo,$estructFilter);
        
        return $DocumentoPorTitulo;
    }
}

?>