<?php

require_once "conexion.php";

Class ModeloNoticiasInicio{
    /*====================================================
            MOSTRAR LAS ULTIMAS NOTICIAS EN EL INICIO
    =====================================================*/

    static public function mdlMostrarNoticiasInicio($tabla1, $tabla2, $tabla3) {
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
            INNER JOIN $tabla3 u
            ON n.creado_por = u.id
            WHERE n.pasivo = 0
            ORDER BY n.id DESC LIMIT 3"
        );
        $stmt -> execute();
        return $stmt -> fetchAll();

        $stmt = null;
    }

    static public function mdlMostrarNoticiasJuridico($tabla1, $tabla2, $tabla3) {
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
            INNER JOIN $tabla3 u
            ON n.creado_por = u.id
            WHERE n.pasivo = 0
            ORDER BY n.id DESC LIMIT 1"
        );
        $stmt -> execute();
        return $stmt -> fetchAll();

        $stmt = null;
    }

    /* Ocurria un error al consultar la funcion mdlMostrarNoticiasInicio, en plantilla al buscar la noticia seleccionada, ocupaba
    esta funcion y solo cargaba 3 noticias, entonces pasando de estas no funcionaba esta consulta para la seccion de notimeffca.
    Se propone esta nueva funcion, que llama a todas las noticias no pasivas y se hace la comparacion en base a estos resultados. */
    static public function mdlMostrarTodasNoticias($tabla1, $tabla2, $tabla3) {
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
            INNER JOIN $tabla3 u
            ON n.creado_por = u.id
            WHERE n.pasivo = 0"
        );
        $stmt -> execute();
        return $stmt -> fetchAll();

        $stmt = null;
    }
}