<?php

require_once "conexion.php";

Class ModeloEstructura{
    /*====================================================
        CARGAR LOS TITULOS DE LAS DIRECCIONES EN EL INICIO
    =====================================================*/

    static public function mdlCargarTitulosDirecciones($tabla1, $tabla2, $codigo) {
        $stmt = Conexion::conectar()->prepare("SELECT ie.id AS id,
            ie.titulo AS titulo
            FROM $tabla1 ie
            INNER JOIN $tabla2 c
            ON c.id = ie.estructura_id
            WHERE c.id = $codigo
            AND ie.pasivo = 0
            ORDER BY ie.id ASC
        ");
        
        $stmt -> execute();
        return $stmt -> fetchAll();

        $stmt = null;
    }

    /*====================================================
            MOSTRAR LA ESTRUCTURA SELECCIONADA
    =====================================================*/

    static public function mdlMostrarEstructura($tabla1, $tabla2, $id) {
        $stmt = Conexion::conectar()->prepare("SELECT ie.id AS id,
        ie.titulo AS titulo,
        ie.imagen AS imagen,
        ie.descripcion AS descripcion
        FROM $tabla1 ie
        INNER JOIN $tabla2 c
        ON c.id = ie.estructura_id
        WHERE ie.id = :id
        AND ie.pasivo = 0
        ");

        $stmt -> bindParam(":id", $id, PDO::PARAM_INT);
        $stmt -> execute();
        return $stmt -> fetchAll(PDO::FETCH_ASSOC);

        $stmt = null;
    }
}