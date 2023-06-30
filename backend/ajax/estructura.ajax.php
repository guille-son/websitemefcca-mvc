<?php

require_once "../controladores/estructura.controlador.php";
require_once "../modelos/estructura.modelo.php";

class AjaxEstructura {

    // ====================================================== //
    // ================= Registro Estructura ================ //
    // ====================================================== //
    public $idCatalogo;
    public $catalogo;
    public $titulo;
    public $imagen;
    public $tipoImagen;
    public $descripcion;

    public function ajaxRegistroEstructura(){

        $datos = array(
            "idCatalogo" => $this -> idCatalogo,
            "catalogo" => $this -> catalogo,
            "titulo" => $this -> titulo,
            "tipoImagen" => $this -> tipoImagen,
            "imagen" => $this -> imagen,
            "descripcion" => $this -> descripcion
        );

        $respuesta = ControladorEstructura::ctrRegistroEstructura($datos);

        echo $respuesta;
        
    }

    // ====================================================== //
    // ================= Edicion Estructura ================= //
    // ====================================================== //
    public $idEstructura;
    public $idCatalogoEditar;
    public $catalogoEditar;
    public $tituloEditar;
    public $tipoImagenEditar;
    public $imagenNueva;
    public $imagenAntigua;
    public $descripcionEditar;

    public function ajaxEditarEstructura(){

        $datos = array(
            "idEstructura" => $this -> idEstructura,
            "idCatalogo" => $this -> idCatalogoEditar,
            "catalogo" => $this -> catalogoEditar,
            "titulo" => $this -> tituloEditar,
            "tipoImagenEditar" => $this -> tipoImagenEditar,
            "imagenNueva" => $this -> imagenNueva,
            "imagenAntigua" => $this -> imagenAntigua,
            "descripcion" => $this -> descripcionEditar
        );

        $respuesta = ControladorEstructura::ctrEditarEstructura($datos);

        echo $respuesta;
        
    }

    // ====================================================== //
    // ================= Eliminar Estructura ================ //
    // ====================================================== //
    public $idEliminar;
    public $imagenEstructura;

    public function ajaxEliminarEstructura(){

        $datos = array(
            "idEliminar" => $this -> idEliminar,
            "imagenEstructura" => $this -> imagenEstructura
        );

        $respuesta = ControladorEstructura::ctrEliminarEstructura($datos);

        echo $respuesta;
        
    }

    // ====================================================== //
    // ============ CARGAR TODAS LAS ESTRUCTURAS ============ //
    // ====================================================== //

    public $idEstructuraEditar;

    public function ajaxCargarEstructuras(){

        $id = $this -> idEstructuraEditar;

        $respuesta = ControladorEstructura::ctrCargarEstructura($id);

        echo json_encode($respuesta);
        
    }

}

// ====================================================== //
// ================= Registro Estructura ================ //
// ====================================================== //
if(isset($_POST["tipo"]) && $_POST["tipo"] == 'registroEstructura'){

    $registro = new AjaxEstructura();
    $registro -> idCatalogo = $_POST["idCatalogo"];
    $registro -> catalogo = $_POST["catalogo"];
    $registro -> titulo = $_POST["titulo"];
    $registro -> tipoImagen = $_POST["tipoImagen"];
    $registro -> imagen = $_POST["imagen"];
    $registro -> descripcion = $_POST["descripcion"];
    $registro -> ajaxRegistroEstructura();

}

// ====================================================== //
// ================= Edicion Estructura ================= //
// ====================================================== //
if(isset($_POST["tipo"]) && $_POST["tipo"] == 'editarEstructura'){

    $editar = new AjaxEstructura();
    $editar -> idEstructura = $_POST["idEstructura"];
    $editar -> idCatalogoEditar = $_POST["idCatalogo"];
    $editar -> catalogoEditar = $_POST["catalogo"];
    $editar -> tituloEditar = $_POST["titulo"];
    $editar -> tipoImagenEditar = $_POST["tipoImagen"];
    $editar -> imagenNueva = $_POST["imagenNueva"];
    $editar -> imagenAntigua = $_POST["imagenAntigua"];
    $editar -> descripcionEditar = $_POST["descripcion"];
    $editar -> ajaxEditarEstructura();

}

// ====================================================== //
// ================= Eliminar Estructura ================ //
// ====================================================== //
if(isset($_POST["idEliminar"])){

    $eliminar = new AjaxEstructura();
    $eliminar -> idEliminar = $_POST["idEliminar"];
    $eliminar -> imagenEstructura = $_POST["imagenEstructura"];
    $eliminar -> ajaxEliminarEstructura();

}


// ====================================================== //
// ============ CARGAR TODAS LAS ESTRUCTURAS ============ //
// ====================================================== //
if(isset($_POST["tipo"]) && $_POST["tipo"] == 'CargarEstructura'){

    $cargar = new AjaxEstructura();
    $cargar -> idEstructuraEditar = $_POST["idEstructura"];
    $cargar -> ajaxCargarEstructuras();

}
