<?php
include "../modelos/notimefcca.modelo.php";

// Decodifico el parametro enviado, servira para realizar la consulta
$tipo = $_POST['tipo'];

if($tipo == 'cargar_paginacion'){ // Peticion de informacion para notimefcca
    $pagina = $_POST['paginaActual'] - 1;
    $pageSize = $_POST['pageSize'];
    $titulo = $_POST['titulo'];
    die(ControladorNotimefcca::ctrCargarNoticias($pagina,$pageSize,$titulo));
}

if($tipo == 'IdCount'){
    $titulo = $_POST['titulo'];
    die(ControladorNotimefcca::ctrCargarId($titulo));
}

Class ControladorNotimefcca{
    /*====================================================
            PETICIONES PARA NOTIMEFCCA
    =====================================================*/

    /* Carga noticias segun la pagina actual de la paginacion */
    static public function ctrCargarNoticias($pagina,$pageSize,$titulo){
        $paginaNoticia = ModeloNotimefcca::mdlCargaNoticias($pagina,$pageSize,$titulo);
        return $paginaNoticia;
    }

    static public function ctrCargarId($titulo){
        $ids = ModeloNotimefcca::mdlNumNoticias($titulo);

        return $ids;
    }
}

?>