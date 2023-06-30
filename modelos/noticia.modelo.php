<?php

require_once "conexion.php";

Class ModeloNoticia{
    /*====================================================
            MOSTRAR LA NOTICIA SELECCIONADA
    =====================================================*/

    static public function mdlMostrarNoticia($tabla1, $tabla2, $tabla3, $id) {
        $stmt = Conexion::conectar()->prepare("SELECT n.titulo_noticia AS titulo,
            n.descrip_noticia AS descripcion,
            n.imagen AS imagen_destacada,
            n.galeria as galeria,
            CONCAT_WS(' ', u.nombres, u.apellidos) AS nombre_completo,
            DATE(n.creado_el) AS fecha,
            TIME(n.creado_el) AS hora,
            n.link_twitter AS twitter,
            n.link_facebook AS facebook,
            n.link_instagram AS instagram,
            n.id AS id
            FROM $tabla1 n
            INNER JOIN $tabla3 u
            ON n.creado_por = u.id
            WHERE n.pasivo = 0
            AND n.id = :id"
        );
        $stmt -> bindParam(":id", $id, PDO::PARAM_INT);
        $stmt -> execute();
        return $stmt -> fetchAll(PDO::FETCH_ASSOC);

        $stmt = null;
    }
}