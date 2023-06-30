<?php

require_once "conexion.php";

Class ModeloBanner{
    /*====================================================
            MOSTRAR BANNER
    =====================================================*/

    static public function mdlMostrarBanner($tabla) {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE pasivo = false AND estado = 0 ORDER BY orden ASC");
        $stmt -> execute();
        return $stmt -> fetchAll();

        $stmt = null;
    }
}