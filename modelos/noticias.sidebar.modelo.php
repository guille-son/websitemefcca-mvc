<?php

require_once "conexion.php";

Class ModeloNoticiasSidebar{
    /*====================================================
        MOSTRAR LAS ULTIMAS 2 NOTICIAS EN EL SIDEBAR
    =====================================================*/

    static public function mdlMostrarNoticiasSidebar($tabla1, $tabla2, $id) {
        $stmt = Conexion::conectar()->prepare("SELECT n.id AS id,
            n.titulo_noticia AS titulo,
            n.descrip_noticia_corta AS descripcion_corta,
            n.imagen AS imagen_noticia,
            CONCAT_WS(' ', u.nombres, u.apellidos) AS nombre_completo,
            DATE(n.creado_el) AS fecha,
            TIME(n.creado_el) AS hora,
            n.link_twitter AS twitter,
            n.link_facebook AS facebook,
            n.link_instagram AS instagram
            FROM $tabla1 n
            INNER JOIN $tabla2 u
            ON n.creado_por = u.id
            WHERE n.pasivo = 0
            AND n.id NOT IN ($id)
            ORDER BY n.id DESC LIMIT 2"
        );
        $stmt -> execute();
        return $stmt -> fetchAll();

        $stmt = null;
    }

    static public function mdlSideBarNoticiasTopDos($tabla1, $tabla2) {
        $stmt = Conexion::conectar()->prepare("SELECT n.id AS id,
            n.titulo_noticia AS titulo,
            n.descrip_noticia_corta AS descripcion_corta,
            n.imagen AS imagen_noticia,
            CONCAT_WS(' ', u.nombres, u.apellidos) AS nombre_completo,
            DATE(n.creado_el) AS fecha,
            TIME(n.creado_el) AS hora,
            n.link_twitter AS twitter,
            n.link_facebook AS facebook,
            n.link_instagram AS instagram
            FROM $tabla1 n
            INNER JOIN $tabla2 u
            ON n.creado_por = u.id
            WHERE n.pasivo = 0
            ORDER BY n.id DESC LIMIT 2"
        );
        $stmt -> execute();
        return $stmt -> fetchAll();

        $stmt = null;
    }
}