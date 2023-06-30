<?php

require_once "../controladores/videos.controlador.php";
require_once "../modelos/videos.modelo.php";

class AjaxVideos{
    // ====================================================== //
    // ==================== Editar Video ==================== //
    // ====================================================== //

    public $idVideo;

    public function ajaxMostrarVideos() {
        $item = "id";
        $valor = $this -> idVideo;
        $respuesta = ControladorVideos::ctrMostrarVideos($item, $valor);

        echo json_encode($respuesta);
    }

    // ====================================================== //
    // ================== Eliminar Video ==================== //
    // ====================================================== //

    public $idEliminar;

    public function ajaxEliminarVideo() {

        $respuesta = ControladorVideos::ctrEliminarVideos($this -> idEliminar);

        echo $respuesta;
    }


}

// ====================================================== //
// ==================== Editar Video ==================== //
// ====================================================== //
if(isset($_POST["idVideoEditar"])){
    $editar = new AjaxVideos();
    $editar -> idVideo = $_POST["idVideoEditar"];
    $editar -> ajaxMostrarVideos();
}

// ====================================================== //
// ================== Eliminar Video ==================== //
// ====================================================== //
if(isset($_POST["idEliminar"])){
    $eliminar = new AjaxVideos();
    $eliminar -> idEliminar = $_POST["idEliminar"];
    $eliminar -> ajaxEliminarVideo();
}
