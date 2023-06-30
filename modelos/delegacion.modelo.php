<?php

require_once "conexion.php";

Class ModeloDelegacion{
    /*====================================================
            MOSTRAR DELEGACIONES
    =====================================================*/

    static public function mdlMostrarDelegacion() {
        $query = "SELECT
        dd.nombre_delegacion,
        dd.nombre_delegado,
        dd.direccion_delegacion,
        dd.email_delegacion,
        dd.telefono_delegacion,
        dd.nombre_imagen_delegacion_subida,
        dd.cuenta_twitter as twitter,
        dd.cuenta_facebook as facebook,
        dd.cuenta_instagram as instagram
        FROM datos_delegacion dd
        WHERE dd.pasivo = 0;";

        try{
            $consulta = Conexion::conectar()->prepare($query);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta = null;
        return json_encode($resultado);
    }
}

?>