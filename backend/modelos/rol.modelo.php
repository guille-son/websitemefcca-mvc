<?php

require_once "conexion.php";

class ModeloRol {
    /*==========================================
    Mostrar Roles de Usuario
    ==========================================*/
    static public function mdlMostrarRoles($tabla) {
        $stmt = Conexion::conectar() -> prepare("SELECT id, 
        descripcion 
        FROM $tabla
        WHERE pasivo = false
        AND ref_tipo_catalogo LIKE 'ROL'");

        $stmt -> execute();

        return $stmt -> fetchAll(PDO::FETCH_ASSOC);

        $stmt = null;
    }

    /*==========================================
    Mostrar Roles de Usuario al Editar
    ==========================================*/
    static public function mdlMostrarRolesEditar($tabla, $idRol) {

        $stmt = Conexion::conectar() -> prepare("SELECT id,
        descripcion 
        FROM $tabla
        WHERE pasivo = false
        AND ref_tipo_catalogo LIKE 'ROL'
        AND id NOT IN (:rol_id)");

        $stmt->bindParam(":rol_id", $idRol, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetchAll(PDO::FETCH_ASSOC);

        $stmt = null;
    }
}