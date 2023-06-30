<?php

include '../modelos/ordenbanner.modelo.php';

$tipo = $_POST['tipo'];

if($tipo == 'orden'){

    die(ControladorOrden::ctrMostrarOrdenEditar());

}

Class ControladorOrden{

    /*==========================================
    Mostrar Orden de Usuario al Editar
    ==========================================*/
    static public function ctrMostrarOrdenEditar(){
        $tabla = "banner";
        $id = $_POST["id"];

        $respuesta = ModeloOrden::mdlMostrarOrdenEditar($tabla, $id);

        return json_encode($respuesta);
    }

}