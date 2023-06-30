<?php

require_once "conexion.php";

class ModeloCatalogo {

    /* ===================================================
    MOSTRAR LOS DATOS DEL CATALOGO POR ID
    ======================================================*/
    static public function mdlObtenerCatalogoPorId($tabla, $id) {

        $stmt = Conexion::conectar() -> prepare("SELECT id AS id,
        descripcion AS catalogo
        FROM $tabla
        WHERE pasivo = 0
        AND id = :id");

        $stmt -> bindParam(":id", $id, PDO::PARAM_INT);

        $stmt -> execute();

        return $stmt -> fetch();
        
        $stmt = null;

    }

    /* ===================================================
    MOSTRAR LOS DATOS DEL CATALOGO POR CODIGO DE REFERENCIA
    ======================================================*/
    static public function mdlMostrarCatalogoPorCodigo($tabla, $codigo) {

        $stmt = Conexion::conectar() -> prepare("SELECT id AS id,
        descripcion AS catalogo
        FROM $tabla
        WHERE pasivo = 0
        AND ref_tipo_catalogo = :codigo");

        $stmt -> bindParam(":codigo", $codigo, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetchAll();

        $stmt = null;
        
    }

    /* ===================================================
    CARGAR LOS DATOS DEL CATALOGO POR CODIGO DE REFERENCIA
    Y EXCLUIR UN ID
    ======================================================*/
    static public function mdlCargarCatalogo($tabla, $id, $codigo) {

        $stmt = Conexion::conectar() -> prepare("SELECT id,
        descripcion
        FROM $tabla
        WHERE pasivo = 0
        AND ref_tipo_catalogo = :codigo
        AND id NOT IN (:id_catalogo)");

        $stmt -> bindParam(":codigo", $codigo, PDO::PARAM_STR);
        $stmt -> bindParam(":id_catalogo", $id, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetchAll(PDO::FETCH_ASSOC);

        $stmt = null;
        
    }

}