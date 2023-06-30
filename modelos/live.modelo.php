<?php

require_once "conexion.php";

Class ModeloLive{
    /*====================================================
            
    =====================================================*/
    static public function obtenerLink($tabla) {
        $stmt = Conexion::conectar()->prepare("SELECT link_transmision as link, 
        hora_finalizacion as fin, 
        DATE(creado_el) AS fecha, 
        TIME(creado_el) AS registrado 
        FROM $tabla
        WHERE pasivo = false
        AND estado = false
        ORDER BY id DESC LIMIT 1
        ");
        $stmt -> execute();
        return $stmt -> fetch();

        $stmt = null;
    }
}