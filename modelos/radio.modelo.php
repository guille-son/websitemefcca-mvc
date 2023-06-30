<?php

require_once "conexion.php";

class ModeloRadio
{
    /*====================================================
            MOSTRAR LA NOTICIA SELECCIONADA
    =====================================================*/

    static public function mdlMostrarRadio($tabla1, $tabla2)
    {
        $stmt = Conexion::conectar()->prepare("SELECT
        pr.id as id,
        pr.tema as tema,
        pr.link_programa as linkPrograma,
        pr.fecha_programa as fechaPrograma,
        DATE(pr.creado_el) AS fecha,
        TIME(pr.creado_el) AS hora
        FROM $tabla1 pr
        INNER JOIN $tabla2 u
        ON pr.creado_por = u.id
        WHERE pr.pasivo = 0
        order by pr.id desc"
        );

        $stmt -> execute();
        return $stmt -> fetchAll();
        $stmt = null;
    }

    static public function mdlMostrarRadioPrincipal($tabla1, $tabla2)
    {
        $stmt = Conexion::conectar()->prepare("SELECT
        pr.id as id,
        pr.tema as tema,
        pr.link_programa as linkPrograma,
        pr.fecha_programa as fechaPrograma,
        DATE(pr.creado_el) AS fecha,
        TIME(pr.creado_el) AS hora
        FROM $tabla1 pr
        INNER JOIN $tabla2 u
        ON pr.creado_por = u.id
        WHERE pr.pasivo = 0
        order by pr.id desc limit 1"
        );

        $stmt -> execute();
        return $stmt -> fetchAll();
        $stmt = null;
    }
}
