<?php

require_once "conexion.php";

class ModeloOrden {

    /*==========================================
    Mostrar Orden de los registros del banner al Editar
    ==========================================*/
    static public function mdlMostrarOrdenEditar($tabla, $id) {

        $stmt = Conexion::conectar() -> prepare("SELECT id,
        orden
        FROM $tabla
        WHERE pasivo = false
        AND id NOT IN (:id)");

        $stmt->bindParam(":id", $id, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetchAll(PDO::FETCH_ASSOC);

        $stmt = null;
    }
}