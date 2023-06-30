<?php

require_once "conexion.php";

class ModeloEstructura {

    /* ===================================================
    MOSTRAR LAS ESTRUCTURAS CON INNER JOIN
    ======================================================*/

    static public function mdlMostrarEstructuras($tabla1, $tabla2, $item, $valor) {
        
        if($item != null && $valor != null) {

            $stmt = Conexion::conectar() -> prepare("SELECT ie.id AS id,
            c.id AS id_catalogo,
            c.descripcion AS catalogo,
            ie.titulo AS titulo,
            ie.imagen AS imagen,
            ie.descripcion AS descripcion
            FROM $tabla1 ie
            INNER JOIN $tabla2 c
            ON c.id = ie.estructura_id
            WHERE c.pasivo = 0
            AND ie.pasivo = 0
            AND ie.$item = :$item");

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetch();

        } else {

            $stmt = Conexion::conectar() -> prepare("SELECT ie.id AS id,
            c.id AS id_catalogo,
            c.descripcion AS catalogo,
            ie.titulo AS titulo,
            ie.imagen AS imagen,
            ie.descripcion AS descripcion
            FROM $tabla1 ie
            INNER JOIN $tabla2 c
            ON c.id = ie.estructura_id
            WHERE c.pasivo = 0
            AND ie.pasivo = 0
            ORDER BY ie.id DESC");

            $stmt -> execute();

            return $stmt -> fetchAll();

        }

        $stmt = null;
    }

    /*==========================================
    Cargar Estructuras al Editar un Video
    ==========================================*/
    static public function mdlCargarEstructuras($tabla, $id) {

        $stmt = Conexion::conectar() -> prepare("SELECT id, titulo 
        FROM $tabla
        WHERE pasivo = false
        AND id NOT IN (:id_estructura)");

        $stmt->bindParam(":id_estructura", $id, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetchAll(PDO::FETCH_ASSOC);

        $stmt = null;

    }

    /*==========================================
    Obtener el consecutivo de la proxima estructura
    ==========================================*/
    static public function mdlRegistroConsecutivo() {

        $stmt = Conexion::conectar()->prepare(
            "SELECT
                CASE 
                    WHEN MAX(id) IS NULL THEN 1
                    ELSE MAX(id)+1
                END AS id
            FROM informacion_estructura"
        );

        $stmt -> execute();

        return $stmt -> fetch(PDO::FETCH_ASSOC);

        $stmt = null;
    }

    /*==========================================
    Registro Estructura
    ==========================================*/
    static public function mdlRegistroEstructura($tabla, $datos) {

        $stmt = Conexion::conectar()->prepare(
            "INSERT INTO $tabla(estructura_id, titulo, imagen, descripcion, creado_por, creado_en_ip)
            VALUES(:estructura_id, :titulo, :imagen, :descripcion, :creado_por, :creado_en_ip)"
        );

        $stmt->bindParam(':estructura_id', $datos["id_catalogo"], PDO::PARAM_INT);
        $stmt->bindParam(':titulo', $datos["titulo"], PDO::PARAM_STR);
        $stmt->bindParam(':imagen', $datos["imagen"], PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $datos["descripcion"], PDO::PARAM_STR);
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
    Editar Estructura
    ==========================================*/
    static public function mdlEditarEstructura($tabla, $datos){

        $stmt = Conexion::conectar()->prepare(
            "UPDATE $tabla SET estructura_id = :estructura_id, titulo = :titulo, imagen = :imagen, descripcion = :descripcion,
            modificado_el = :modificado_el, modificado_por = :modificado_por, modificado_en_ip = :modificado_en_ip
            WHERE id = :id"
        );

        $stmt->bindParam(':estructura_id', $datos["id_catalogo"], PDO::PARAM_INT);
        $stmt->bindParam(':titulo', $datos["titulo"], PDO::PARAM_STR);
        $stmt->bindParam(':imagen', $datos["imagen"], PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $datos["descripcion"], PDO::PARAM_STR);
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
    Eliminar Estructura
    ==========================================*/
    static public function mdlEliminarEstructura($tabla, $data) {
        
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