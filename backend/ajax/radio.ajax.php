<?php

require_once "../controladores/radio.controlador.php";
require_once "../modelos/radio.modelo.php";

class AjaxRadio{
    // ====================================================== //
    // ============== Editar Programas de Radio ============= //
    // ====================================================== //

    public $idRadio;

    public function ajaxMostrarRadio() {
        $item = "id";
        $valor = $this -> idRadio;
        $respuesta = ControladorRadio::ctrMostrarProgramasRadio($item, $valor);

        echo json_encode($respuesta);
    }

    // ====================================================== //
    // ============= Eliminar Programa de Radio ============= //
    // ====================================================== //
    public $idEliminar;
    public $programa;

    public function ajaxEliminarRadio(){

        $datos = array(
            "idEliminar" => $this -> idEliminar,
            "programa" => $this -> programa
        );

        $respuesta = ControladorRadio::ctrEliminarRadio($datos);

        echo $respuesta;
        
    }

}

// ====================================================== //
// ============= Editar Programa de Radio =============== //
// ====================================================== //
if(isset($_POST["idRadio"])){
    $editar = new AjaxRadio();
    $editar -> idRadio = $_POST["idRadio"];
    $editar -> ajaxMostrarRadio();
}

// ====================================================== //
// ============= Eliminar Programa de Radio ============= //
// ====================================================== //
if(isset($_POST["idEliminar"])){

    $eliminar = new AjaxRadio();
    $eliminar -> idEliminar = $_POST["idEliminar"];
    $eliminar -> programa = $_POST["programa"];
    $eliminar -> ajaxEliminarRadio();

}