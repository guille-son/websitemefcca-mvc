<?php

require_once "../controladores/delegaciones.controlador.php";
require_once "../modelos/delegaciones.modelo.php";

class AjaxDelegaciones{
    // ====================================================== //
    // ================== Editar Delegación ================= //
    // ====================================================== //

    public $idDelegacion;

    public function ajaxMostrarDelegacion() {
        $item = "id";
        $valor = $this -> idDelegacion;
        $respuesta = ControladorDelegaciones::ctrMostrarDelegaciones($item, $valor);

        echo json_encode($respuesta);
    }

    // ====================================================== //
    // ================= Eliminar Delegacion ================ //
    // ====================================================== //
    public $idEliminar;
    public $imagen;

    public function ajaxEliminarDelegacion(){

        $datos = array(
            "idEliminar" => $this -> idEliminar,
            "imagen" => $this -> imagen
        );

        $respuesta = ControladorDelegaciones::ctrEliminarDelegacion($datos);

        echo $respuesta;
        
    }


}

// ====================================================== //
// ================= Editar Delegación ================== //
// ====================================================== //
if(isset($_POST["idDelegacion"])){
    $editar = new AjaxDelegaciones();
    $editar -> idDelegacion = $_POST["idDelegacion"];
    $editar -> ajaxMostrarDelegacion();
}

// ====================================================== //
// ================= Eliminar Delegacion ================ //
// ====================================================== //
if(isset($_POST["idEliminar"])){

    $eliminar = new AjaxDelegaciones();
    $eliminar -> idEliminar = $_POST["idEliminar"];
    $eliminar -> imagen = $_POST["imagen"];
    $eliminar -> ajaxEliminarDelegacion();

}