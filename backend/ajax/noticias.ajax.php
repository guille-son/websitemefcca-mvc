<?php

require_once "../controladores/noticias.controlador.php";
require_once "../modelos/noticias.modelo.php";

class AjaxNoticias {

    // ====================================================== //
    // ================== Eliminar Noticia ================== //
    // ====================================================== //
    public $idEliminar;
    public $imagenPrincipal;
    public $galeriaNoticia;

    public function ajaxEliminarNoticia(){

        $datos = array(
            "idEliminar" => $this -> idEliminar,
            "imagenPrincipal" => $this -> imagenPrincipal,
            "galeriaNoticia" => $this -> galeriaNoticia
        );

        $respuesta = ControladorNoticias::ctrEliminarNoticia($datos);

        echo $respuesta;
        
    }

}

// ====================================================== //
// ================== Eliminar Noticia ================== //
// ====================================================== //
if(isset($_POST["idEliminar"])){

    $eliminar = new AjaxNoticias();
    $eliminar -> idEliminar = $_POST["idEliminar"];
    $eliminar -> imagenPrincipal = $_POST["imagenPrincipal"];
    $eliminar -> galeriaNoticia = $_POST["galeriaNoticia"];
    $eliminar -> ajaxEliminarNoticia();

}
