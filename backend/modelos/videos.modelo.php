<?php
require_once "conexion.php";

class ModeloVideos {

    // ====================================================== //
    // =================== Mostrar Videos =================== //
    // ====================================================== //
    static public function mdlMostrarVideos($tabla1, $tabla2, $tabla3, $item, $valor) {
        
        if($item != null && $valor != null) {

            $stmt = Conexion::conectar() -> prepare("SELECT v.id AS id,
            ie.id AS id_estructura,
            ie.titulo AS estructura,
            c.id AS id_catalogo,
            c.descripcion AS catalogo,
            v.titulo_video AS titulo,
            v.link_video AS link
            FROM $tabla1 v
            INNER JOIN $tabla2 c
            ON c.id = v.categoria_video
            INNER JOIN $tabla3 ie
            ON ie.id = v.estructura_id
            WHERE c.pasivo = 0
            AND v.pasivo = 0
            AND ie.pasivo = 0
            AND v.$item = :$item");

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetch();

        } else {

            $stmt = Conexion::conectar() -> prepare("SELECT v.id AS id,
            ie.id AS id_estructura,
            ie.titulo AS estructura,
            c.id AS id_catalogo,
            c.descripcion AS catalogo,
            v.titulo_video AS titulo,
            v.link_video AS link
            FROM $tabla1 v
            INNER JOIN $tabla2 c
            ON c.id = v.categoria_video
            INNER JOIN $tabla3 ie
            ON ie.id = v.estructura_id
            WHERE c.pasivo = 0
            AND v.pasivo = 0
            AND ie.pasivo = 0
            ORDER BY v.id DESC");

            $stmt -> execute();

            return $stmt -> fetchAll();

        }

        $stmt = null;
    }

    /*==========================================
    Registro de Video
    ==========================================*/
    static public function mdlRegistroVideo($tabla, $datos) {
        
        $stmt = Conexion::conectar()->prepare(
            "INSERT INTO $tabla(estructura_id, categoria_video, titulo_video, link_video,
            creado_por, creado_en_ip)
            VALUES(:estructura_id, :categoria_id, :titulo, :link, :creado_por, :creado_en_ip)"
        );

        $stmt->bindParam(':estructura_id', $datos["estructura_id"], PDO::PARAM_INT);
        $stmt->bindParam(':categoria_id', $datos["categoria_id"], PDO::PARAM_INT);
        $stmt->bindParam(':titulo', $datos["titulo"], PDO::PARAM_STR);
        $stmt->bindParam(':link', $datos["link"], PDO::PARAM_STR);
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
    Editar Video
    ==========================================*/
    static public function mdlEditarVideo($tabla, $datos){

        $stmt = Conexion::conectar()->prepare(
            "UPDATE $tabla SET estructura_id = :estructura_id, categoria_video = :categoria_id,
            titulo_video = :titulo, link_video = :link, modificado_el = :modificado_el,
            modificado_por = :modificado_por, modificado_en_ip = :modificado_en_ip
            WHERE id = :id"
        );

        $stmt->bindParam(':estructura_id', $datos["estructura_id"], PDO::PARAM_INT);
        $stmt->bindParam(':categoria_id', $datos["categoria_id"], PDO::PARAM_INT);
        $stmt->bindParam(':titulo', $datos["titulo"], PDO::PARAM_STR);
        $stmt->bindParam(':link', $datos["link"], PDO::PARAM_STR);
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
    Eliminar Video
    ==========================================*/
    static public function mdlEliminarVideo($tabla, $datos){

        $stmt = Conexion::conectar()->prepare(
            "UPDATE $tabla SET pasivo = true, modificado_el = :modificado_el,
            modificado_por = :modificado_por, modificado_en_ip = :modificado_en_ip
            WHERE id = :id"
        );

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

}