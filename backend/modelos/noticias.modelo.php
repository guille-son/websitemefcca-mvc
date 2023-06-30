<?php

require_once "conexion.php";

class ModeloNoticias {

    /* ====================================================
    MOSTRAR LAS ESTRUCTURA - NOTICIAS CON INNER JOIN
    =======================================================*/
    static public function mdlMostrarNoticias($tabla1, $tabla2, $valor)
    {
        if($valor != null){

            $stmt = Conexion::conectar()->prepare(
                "SELECT n.id AS id,
                e.id AS id_estructura,
                e.titulo AS estructura,
                n.titulo_noticia AS titulo,
                n.imagen AS imagen_destacada,
                n.link_twitter AS twitter,
                n.link_facebook AS facebook,
                n.link_instagram AS instagram,
                n.descrip_noticia AS descripcion,
                n.descrip_noticia_corta AS descrip_corta,
                n.galeria AS galeria
                FROM $tabla1 n
                INNER JOIN $tabla2 e
                ON e.id = n.estructura_id
                WHERE n.pasivo = 0
                AND e.pasivo = 0
                AND n.id = :id"
            );

            $stmt -> bindParam(":id", $valor, PDO::PARAM_INT);

            $stmt -> execute();

            return $stmt -> fetch();

        } else {

            $stmt = Conexion::conectar()->prepare(
                "SELECT n.id AS id,
                e.titulo AS estructura,
                n.titulo_noticia AS titulo,
                n.imagen AS imagen_destacada,
                n.link_twitter AS twitter,
                n.link_facebook AS facebook,
                n.link_instagram AS instagram,
                n.descrip_noticia AS descripcion,
                n.descrip_noticia_corta AS descrip_corta,
                n.galeria AS galeria
                FROM $tabla1 n
                INNER JOIN $tabla2 e
                ON e.id = n.estructura_id
                WHERE n.pasivo = 0
                AND e.pasivo = 0
                ORDER BY n.id DESC"
            );

            $stmt -> execute();

            return $stmt -> fetchAll();

        }

        $stmt = null;

    }

    /*==========================================
    Obtener el consecutivo de la proxima noticia
    ==========================================*/
    static public function mdlRegistroConsecutivo() {

        $stmt = Conexion::conectar()->prepare(
            "SELECT
                CASE 
                    WHEN MAX(id) IS NULL THEN 1
                    ELSE MAX(id)+1
                END AS id
            FROM noticia"
        );

        $stmt -> execute();

        return $stmt -> fetch(PDO::FETCH_ASSOC);

        $stmt = null;
    }

    /*==========================================
    Registro Noticia
    ==========================================*/
    static public function mdlRegistroNoticia($tabla, $datos) {

        $stmt = Conexion::conectar()->prepare(
            "INSERT INTO $tabla(estructura_id, titulo_noticia, imagen, descrip_noticia, descrip_noticia_corta, galeria, link_facebook, link_instagram, link_twitter, creado_por, creado_en_ip)
            VALUES(:estructura_id, :titulo_noticia, :imagen, :descrip_noticia, :descrip_noticia_corta, :galeria, :link_facebook, :link_instagram, :link_twitter, :creado_por, :creado_en_ip)"
        );

        $stmt->bindParam(':estructura_id', $datos["id_estructura"], PDO::PARAM_INT);
        $stmt->bindParam(':titulo_noticia', $datos["titulo"], PDO::PARAM_STR);
        $stmt->bindParam(':imagen', $datos["imagen"], PDO::PARAM_STR);
        $stmt->bindParam(':descrip_noticia', $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(':descrip_noticia_corta', $datos["descrip_corta"], PDO::PARAM_STR);
        $stmt->bindParam(':galeria', $datos["galeria"], PDO::PARAM_STR);
        $stmt->bindParam(':link_facebook', $datos["facebook"], PDO::PARAM_STR);
        $stmt->bindParam(':link_instagram', $datos["instagram"], PDO::PARAM_STR);
        $stmt->bindParam(':link_twitter', $datos["twitter"], PDO::PARAM_STR);
        $stmt->bindParam(':creado_por', $datos["creado_por"], PDO::PARAM_INT);
        $stmt->bindParam(':creado_en_ip', $datos["creado_en_ip"], PDO::PARAM_STR);

        if($stmt -> execute()) {

            return "ok";

        } else {

            echo "\nPDO::errorInfo():\n";
            print_r(Conexion::conectar()->errorInfo());

        }
        $stmt = null;        
    }

    /*==========================================
    Editar Noticia
    ==========================================*/
    static public function mdlEditarNoticia($tabla, $datos) {

        $stmt = Conexion::conectar()->prepare(
            "UPDATE $tabla SET id = :id,
            estructura_id = :estructura_id, 
            titulo_noticia = :titulo_noticia, 
            imagen = :imagen, 
            descrip_noticia = :descrip_noticia, 
            descrip_noticia_corta = :descrip_noticia_corta, 
            galeria = :galeria, 
            link_facebook = :link_facebook, 
            link_instagram = :link_instagram, 
            link_twitter = :link_twitter,
            modificado_el = :modificado_el,
            modificado_por = :modificado_por, 
            modificado_en_ip = :modificado_en_ip
            WHERE id = :id"
        );

        $stmt->bindParam(':estructura_id', $datos["id_estructura"], PDO::PARAM_INT);
        $stmt->bindParam(':titulo_noticia', $datos["titulo"], PDO::PARAM_STR);
        $stmt->bindParam(':imagen', $datos["imagen"], PDO::PARAM_STR);
        $stmt->bindParam(':descrip_noticia', $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(':descrip_noticia_corta', $datos["descrip_corta"], PDO::PARAM_STR);
        $stmt->bindParam(':galeria', $datos["galeria"], PDO::PARAM_STR);
        $stmt->bindParam(':link_facebook', $datos["facebook"], PDO::PARAM_STR);
        $stmt->bindParam(':link_instagram', $datos["instagram"], PDO::PARAM_STR);
        $stmt->bindParam(':link_twitter', $datos["twitter"], PDO::PARAM_STR);
        $stmt->bindParam(':modificado_el', $datos["modificado_el"], PDO::PARAM_STR);
        $stmt->bindParam(':modificado_por', $datos["modificado_por"], PDO::PARAM_INT);
        $stmt->bindParam(':modificado_en_ip', $datos["modificado_en_ip"], PDO::PARAM_STR);
        
        $stmt->bindParam(':id', $datos["id"], PDO::PARAM_INT);

        if($stmt -> execute()) {

            return "ok";

        } else {

            echo "\nPDO::errorInfo():\n";
            print_r(Conexion::conectar()->errorInfo());

        }
        $stmt = null;        
    }

    /*==========================================
    Eliminar Noticia
    ==========================================*/
    static public function mdlEliminarNoticia($tabla, $data) {
        
        $stmt = Conexion::conectar()->prepare(
            "UPDATE $tabla SET pasivo = true,
            modificado_el = :modificado_el,
            modificado_por = :modificado_por, 
            modificado_en_ip = :modificado_en_ip
            WHERE id = :id"
        );

        $stmt->bindParam(':modificado_el', $data["modificado_el"], PDO::PARAM_STR);
        $stmt->bindParam(':modificado_por', $data["modificado_por"], PDO::PARAM_INT);
        $stmt->bindParam(':modificado_en_ip', $data["modificado_en_ip"], PDO::PARAM_STR);
        $stmt->bindParam(':id', $data["id"], PDO::PARAM_INT);

        if($stmt -> execute()) {

            return "ok";

        } else {

            echo "\nPDO::errorInfo():\n";
            print_r(Conexion::conectar()->errorInfo());

        }

        $stmt = null;
        
    }
    
}