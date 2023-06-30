<?php

class ControladorCatalogo {

    /* ===================================================
    MOSTRAR CATALOGO POR ID
    ======================================================*/
    static public function ctrMostrarEstructuraPorId($id)
    {

        $tabla = "catalogo";

        $respuesta = ModeloCatalogo::mdlObtenerCatalogoPorId($tabla, $id);

        return $respuesta;

    }

    /* ===================================================
    MOSTRAR CATALOGO POR CODIGO DE REFERENCIA
    ======================================================*/
    static public function ctrMostrarCatalogoPorCodigo($codigo)
    {

        $tabla = "catalogo";

        $respuesta = ModeloCatalogo::mdlMostrarCatalogoPorCodigo($tabla, $codigo);

        return $respuesta;

    }

    /* ===================================================
    CARGAR CATALOGO POR CODIGO Y EXCLUIR UN ID
    ======================================================*/
    static public function ctrCargarCatalogo($id, $ref){

        $tabla = "catalogo";

        $respuesta = ModeloCatalogo::mdlCargarCatalogo($tabla, $id, $ref);

        return $respuesta;

    }

}