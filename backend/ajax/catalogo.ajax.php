<?php

require_once "../controladores/catalogo.controlador.php";
require_once "../modelos/catalogo.modelo.php";

class AjaxCatalogo {

    // ====================================================== //
    // ===== CARGAR CATALOGO POR CODIGO Y ID (EXCLUIR) ====== //
    // ====================================================== //

    public $idCatalogoEditar;
    public $codigo;

    public function ajaxCargarCatalogo(){

        $id = $this -> idCatalogoEditar;
        $ref = $this -> codigo;

        $respuesta = ControladorCatalogo::ctrCargarCatalogo($id, $ref);

        echo json_encode($respuesta);
        
    }

}
// ====================================================== //
// ============ CARGAR TODAS LAS ESTRUCTURAS ============ //
// ====================================================== //
if(isset($_POST["tipo"]) && $_POST["tipo"] == 'CargarCatalogo'){

    $cargar = new AjaxCatalogo();
    $cargar -> idCatalogoEditar = $_POST["idCatalogo"];
    $cargar -> codigo = $_POST["codigo"];
    $cargar -> ajaxCargarCatalogo();

}
