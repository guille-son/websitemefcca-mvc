<?php
include "../modelos/programasEmblematicos.modelo.php";

// Decodifico el parametro enviado, servira para realizar la consulta
$tipo = $_POST['tipo'];

if($tipo == 'cargar_paginacion'){ // Peticion de informacion para notimefcca
    $pagina = $_POST['paginaActual'] - 1;
    $pageSize = $_POST['pageSize'];
    $titulo = $_POST['titulo'];
    die(ControladorProgramasEmblematicos::ctrCargarPrograma($pagina,$pageSize,$titulo));
}

if($tipo == 'IdCount'){
    $titulo = $_POST['titulo'];
    die(ControladorProgramasEmblematicos::ctrCargarId($titulo));
}

Class ControladorProgramasEmblematicos{
    /*====================================================
            PETICIONES PARA NOTIMEFCCA
    =====================================================*/

    /* Carga prorgamas emblematicos segun la pagina actual de la paginacion */
    static public function ctrCargarPrograma($pagina,$pageSize,$titulo){
        $paginaPrograma = ModeloProgramasEmblematicos::mdlCargaProgramas($pagina,$pageSize,$titulo);
        return $paginaPrograma;
    }

    static public function ctrCargarId($titulo){
        $ids = ModeloProgramasEmblematicos::mdlNumProgramas($titulo);

        return $ids;
    }
}

?>