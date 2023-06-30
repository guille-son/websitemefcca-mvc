<?php

require_once "../controladores/banner.controlador.php";
require_once "../modelos/banner.modelo.php";

class AjaxBanner {

    // ====================================================== //
    // ==================== Editar Banner =================== //
    // ====================================================== //
    public $idBanner;

    public function ajaxMostrarBanner() {

        $item = "id";
        $valor = $this -> idBanner;

        $respuesta = ControladorBanner::ctrMostrarBanner($item, $valor);

        echo json_encode($respuesta);

    }

    // ====================================================== //
    // ================== Eliminar Banner =================== //
    // ====================================================== //

    public $idEliminar;
    public $rutaImagen;

    public function ajaxEliminarBanner() {

        $datos = array(
            "idEliminar" => $this -> idEliminar,
            "rutaImagen" => $this -> rutaImagen
        );

        $respuesta = ControladorBanner::ctrEliminarBanner($datos);

        echo $respuesta;
    }

    // ====================================================== //
    // =================== Estado Banner ==================== //
    // ====================================================== //
    public $idBannerEstado;
    public $estado;

    public function ajaxEstadoBanner() {
        $datos = array(
            "idBannerEstado" => $this -> idBannerEstado,
            "estado" => $this -> estado
        );

        $respuesta = ControladorBanner::ctrEstadoBanner($datos);

        echo json_encode($respuesta);
    }

}

// ====================================================== //
// ==================== Editar Banner =================== //
// ====================================================== //

if(isset($_POST["idBanner"])){

    $editar = new AjaxBanner();
    $editar -> idBanner = $_POST["idBanner"];
    $editar -> ajaxMostrarBanner();

}

// ====================================================== //
// ================== Eliminar Banner =================== //
// ====================================================== //
if(isset($_POST["idEliminar"])){

    $eliminar = new AjaxBanner();
    $eliminar -> idEliminar = $_POST["idEliminar"];
    $eliminar -> rutaImagen = $_POST["rutaImagen"];
    $eliminar -> ajaxEliminarBanner();

}

// ====================================================== //
// ================== Estado Banner ==================== //
// ====================================================== //
if(isset($_POST["estado"])){
    $cambiarEstado = new AjaxBanner();
    $cambiarEstado -> idBannerEstado = $_POST["idBannerEstado"];
    $cambiarEstado -> estado = $_POST["estado"];
    $cambiarEstado -> ajaxEstadoBanner();
}