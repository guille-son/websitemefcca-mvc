<?php

require_once "../controladores/documentos.controlador.php";
require_once "../modelos/documentos.modelo.php";

class AjaxDocumentos{
    // ====================================================== //
    // ================== Editar Documento ================== //
    // ====================================================== //

    public $idDocumento;

    public function ajaxMostrarDocumentos() {
        $item = "id";
        $valor = $this -> idDocumento;
        $respuesta = ControladorDocumentos::ctrMostrarDocumentos($item, $valor);

        echo json_encode($respuesta);
    }

    // ====================================================== //
    // ================= Eliminar Documento ================= //
    // ====================================================== //
    public $idEliminar;
    public $imagen;
    public $archivo;

    public function ajaxEliminarDocumento(){

        $datos = array(
            "idEliminar" => $this -> idEliminar,
            "imagen" => $this -> imagen,
            "archivo" => $this -> archivo
        );

        $respuesta = ControladorDocumentos::ctrEliminarDocumento($datos);

        echo $respuesta;
        
    }

}

// ====================================================== //
// ================= Editar Documento =================== //
// ====================================================== //
if(isset($_POST["idDocumento"])){
    $editar = new AjaxDocumentos();
    $editar -> idDocumento = $_POST["idDocumento"];
    $editar -> ajaxMostrarDocumentos();
}

// ====================================================== //
// ================= Eliminar Documento ================= //
// ====================================================== //
if(isset($_POST["idEliminar"])){

    $eliminar = new AjaxDocumentos();
    $eliminar -> idEliminar = $_POST["idEliminar"];
    $eliminar -> imagen = $_POST["imagen"];
    $eliminar -> archivo = $_POST["archivo"];
    $eliminar -> ajaxEliminarDocumento();

}