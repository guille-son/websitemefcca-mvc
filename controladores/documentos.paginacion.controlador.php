<?php
include "../modelos/documentos.paginacion.modelo.php";

$tipo = $_POST['tipo'];

if($tipo == 'cargar_paginacion'){
    $pagina = $_POST['paginaActual'] - 1;
    $pageSize = $_POST['pageSize'];
    $filtro = $_POST['filtro'];
    $titulo = $_POST['titulo'];
    $estructura =  $_POST['estructura'];
    $estructFilter;

    if($estructura != 'Ninguna'){
        $estructFilter = 'AND doc.estructura_id = ' . $estructura;
    }else{
        $estructFilter = '';
    }

    if($filtro == 'Todos'){
        die(ControladorDocumentosPaginacion::ctrMostrarDocumentos($pagina,$pageSize,$titulo,$estructFilter) );
    }else{
        die(ControladorDocumentosPaginacion::ctrDocumentosFiltroCategoria($pagina,$pageSize,$filtro,$titulo,$estructFilter) );
    }

}

if($tipo == 'IdCount'){
    $filtro = $_POST['filtro'];
    $titulo = $_POST['titulo'];
    $estructura =  $_POST['estructura'];
    $estructFilter;

    if($estructura != 'Ninguna'){
        $estructFilter = 'AND doc.estructura_id = ' . $estructura;
    }else{
        $estructFilter = '';
    }

    if($filtro == 'Todos'){
        die(ControladorDocumentosPaginacion::ctrTotalDocumentos($titulo,$estructFilter));
    }else{
        die(ControladorDocumentosPaginacion::ctrTotalDocumentosFiltroCategoria($filtro,$titulo,$estructFilter) );
    }

}

Class ControladorDocumentosPaginacion{
    /*====================================================
            PETICIONES PARA PAGINACION DE DOCUMENTOS
    =====================================================*/

    /* Carga documentos segun la pagina actual de la paginacion */
    static public function ctrMostrarDocumentos($pagina,$pageSize,$titulo,$estructFilter){
        $paginaDocumentos = ModeloPaginacionDocumentos::mdlMostrarDocumentos($pagina,$pageSize,$titulo,$estructFilter);
        return $paginaDocumentos;
    }

    static public function ctrTotalDocumentos($titulo,$estructFilter){
        $ids = ModeloPaginacionDocumentos::mdlTotalDocumentos($titulo,$estructFilter);

        return $ids;
    }

    static public function ctrBuscarDocumentosPorTitulo($pagina,$pageSize,$titulo,$estructFilter){
        $DocumentoPorTitulo = ModeloPaginacionDocumentos::mdlBuscarDocumentosPorTitulo($pagina,$pageSize,$titulo,$estructFilter);
        
        return $DocumentoPorTitulo;
    }

    static public function ctrDocumentosFiltroCategoria($pagina,$pageSize,$filtro,$titulo,$estructFilter){
        $resultado = ModeloPaginacionDocumentos::mdlDocumentosFiltroCategoria($pagina,$pageSize,$filtro,$titulo,$estructFilter);
        return $resultado;
    }

    static public function ctrTotalDocumentosFiltroCategoria($filtro,$titulo,$estructFilter){
        $resultado = ModeloPaginacionDocumentos::mdlTotalDocumentosFiltradosCategoria($filtro,$titulo,$estructFilter);
        return $resultado;
    }
}

?>