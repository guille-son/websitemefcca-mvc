<?php

require_once "../controladores/transmisiones.controlador.php";
require_once "../modelos/transmisiones.modelo.php";

class AjaxTransmisiones{
    // ====================================================== //
    // ================= Editar Transmision ================= //
    // ====================================================== //
    public $idTransmision;

    public function ajaxMostrarTransmisiones() {
        $item = "id";
        $valor = $this -> idTransmision;
        $respuesta = ControladorTransmisiones::ctrMostrarTransmisiones($item, $valor);

        echo json_encode($respuesta);
    }

    // ====================================================== //
    // =============== Eliminar Transmision ================= //
    // ====================================================== //
    public $idEliminar;

    public function ajaxEliminarTransmision() {

        $respuesta = ControladorTransmisiones::ctrEliminarTransmision($this -> idEliminar);

        echo $respuesta;
    }

    // ====================================================== //
    // ================ Estado Transmision ================== //
    // ====================================================== //
    public $idTransmisionEstado;
    public $estado;

    public function ajaxEstadoTransmision() {
        $datos = array(
            "idTransmision" => $this -> idTransmisionEstado,
            "estado" => $this -> estado
        );

        $respuesta = ControladorTransmisiones::ctrEstadoTransmisiones($datos);

        echo json_encode($respuesta);
    }

}

// ====================================================== //
// ==================Editar Transmision ================= //
// ====================================================== //
if(isset($_POST["idTransmision"])){
    $editar = new AjaxTransmisiones();
    $editar -> idTransmision = $_POST["idTransmision"];
    $editar -> ajaxMostrarTransmisiones();
}

// ====================================================== //
// =============== Eliminar Transmision ================= //
// ====================================================== //
if(isset($_POST["idEliminar"])){
    $eliminar = new AjaxTransmisiones();
    $eliminar -> idEliminar = $_POST["idEliminar"];
    $eliminar -> ajaxEliminarTransmision();
}

// ====================================================== //
// ================ Estado Transmision ================== //
// ====================================================== //
if(isset($_POST["estado"])){
    $cambiarEstado = new AjaxTransmisiones();
    $cambiarEstado -> idTransmisionEstado = $_POST["idTransmision"];
    $cambiarEstado -> estado = $_POST["estado"];
    $cambiarEstado -> ajaxEstadoTransmision();
}