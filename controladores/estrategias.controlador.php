<?php
include "../modelos/estrategias.modelo.php";

// Decodifico el parametro enviado, servira para realizar la consulta
$tipo = $_POST['tipo'];

if($tipo == 'cargar_paginacion'){ // Peticion de informacion para notimefcca
    $pagina = $_POST['paginaActual'] - 1;
    $pageSize = $_POST['pageSize'];
    $titulo = $_POST['titulo'];
    $estructura =  $_POST['estructura'];

    if($estructura != 'Ninguna'){
        die(ControladorEstrategias::ctrCargarEstrategias($pagina,$pageSize,$titulo,$estructura));
    }else{
        die(ControladorEstrategias::ctrCargarEstrategias($pagina,$pageSize,$titulo,-1));
    }
}

if($tipo == 'IdCount'){
    $titulo = $_POST['titulo'];
    $estructura =  $_POST['estructura'];

    if($estructura != 'Ninguna'){
        die(ControladorEstrategias::ctrCargarId($titulo,$estructura));
    }else{
        die(ControladorEstrategias::ctrCargarId($titulo,-1));
    }
}

Class ControladorEstrategias{
    /*====================================================
            PETICIONES PARA NOTIMEFCCA
    =====================================================*/

    /* Carga noticias segun la pagina actual de la paginacion */
    static public function ctrCargarEstrategias($paginaActual, $pageSize, $titulo, $idEstructura){
        $paginaEstrategias = ModeloEstrategias::mdlCargaEstrategias($paginaActual, $pageSize, $titulo, $idEstructura);
        return $paginaEstrategias;
    }

    static public function ctrCargarId($tituloMatch, $idEstructura){
        $ids = ModeloEstrategias::mdlTotalEstrategias($tituloMatch, $idEstructura);

        return $ids;
    }
}

?>