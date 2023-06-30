<?php

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class AjaxUsuarios{
    // ====================================================== //
    // =================== Editar Usuario =================== //
    // ====================================================== //

    public $idUsuario;

    public function ajaxMostrarUsuarios() {
        $item = "id";
        $valor = $this -> idUsuario;
        $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

        echo json_encode($respuesta);
    }

    // ====================================================== //
    // ================= Eliminar Usuario =================== //
    // ====================================================== //

    public $idEliminar;

    public function ajaxEliminarUsuarios() {

        $respuesta = ControladorUsuarios::ctrEliminarUsuarios($this -> idEliminar);

        echo $respuesta;
    }
}

// ====================================================== //
// =================== Editar Usuario =================== //
// ====================================================== //
if(isset($_POST["idUsuario"])){
    $editar = new AjaxUsuarios();
    $editar -> idUsuario = $_POST["idUsuario"];
    $editar -> ajaxMostrarUsuarios();
}

// ====================================================== //
// ================= Eliminar Usuario =================== //
// ====================================================== //
if(isset($_POST["idEliminar"])){
    $eliminar = new AjaxUsuarios();
    $eliminar -> idEliminar = $_POST["idEliminar"];
    $eliminar -> ajaxEliminarUsuarios();
}