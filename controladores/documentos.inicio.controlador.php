<?php

include "../modelos/documentos.inicio.modelo.php";

$tipo = $_POST['tipo'];

if($tipo == 'cargar_paginacion'){
    $titulo = $_POST['titulo'];
    die(ControladorDocumentosInicio::ctrMostrarDocumentosInicio($titulo));
}

if($tipo == 'IdCount'){
    die(ControladorDocumentosInicio::ctrCargarId());
}

Class ControladorDocumentosInicio{

    static public function ctrMostrarDocumentosInicio($texto_busqueda){
        $respuesta = ModeloDocumentosInicio::mdlMostrarDocumentosInicio($texto_busqueda );

        return $respuesta;
    }

    static public function ctrCargarId(){
        $respuesta = ModeloDocumentosInicio::mdlTotalId();
        return $respuesta;
    }
}

?>