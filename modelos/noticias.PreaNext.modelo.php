<?php

require_once "conexion.php";

class ModeloPreaNextNoticia
{
    /*====================================================
                CAPTURAR LOS ID  y el titulo PARA LA LA FUNCIONALIDAD DE LOS BOTONES ANTERIOR Y SIGUIENTE
        =====================================================*/
    
    static public function mdlMostrarIDNoticia($tabla1, $tabla2, $tabla3, $id, $sign)
    {
        $stmt = Conexion::conectar()->prepare(
            "SELECT n.id AS id,
            n.titulo_noticia AS titulo
            FROM $tabla1 n
            INNER JOIN $tabla3 u
            ON n.creado_por = u.id
            WHERE n.pasivo = 0
            AND n.id $sign $id
            LIMIT 1"
        );
        $stmt->execute();
        return $stmt->fetchAll();

        $stmt = null;
    }

    static public function mdlMostrarIDNoticiaPrevious($tabla1, $tabla2, $tabla3, $id, $sign)
    {
        $stmt = Conexion::conectar()->prepare(
            "SELECT n.id AS id,
            n.titulo_noticia AS titulo
            FROM $tabla1 n
            INNER JOIN $tabla3 u
            ON n.creado_por = u.id
            WHERE n.pasivo = 0
            AND n.id $sign $id
            ORDER BY n.id DESC LIMIT 1"
        );
        $stmt->execute();
        return $stmt->fetchAll();

        $stmt = null;
    }
}
